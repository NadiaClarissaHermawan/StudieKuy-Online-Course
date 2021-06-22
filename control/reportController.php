<?php 
    require_once "control/services/viewReport.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/CourseReport.php";
    require_once "model/TopUpReport.php";
    require_once "model/CourseTransactionReport.php";

    class reportController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        //ambil course report 
        public function getCourseReport($nama, $complete, $nilai){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $query = "SELECT p.real_name, mm.nilai_akhir, mm.status_ketuntasan, 
                             mm.status_verifikasi, mm.tanggal_tuntas,
                             c.nama_course, c.batas_nilai_minimum, bb.nama_bidang
                      FROM pengguna p INNER JOIN member m 
                            ON p.id_pengguna = m.id_pengguna
                            INNER JOIN member_course mm
                            ON mm.id_member = m.id_member
                            INNER JOIN courses c 
                            ON c.id_courses = mm.id_courses
                            INNER JOIN bidang_course b 
                            ON b.id_courses = c.id_courses
                            INNER JOIN bidang bb 
                            ON bb.id_bidang = b.id_bidang
                     ";

            $cekFilter = 0;
            //cek filter nama
            if($nama != ""){
                $query .= " WHERE p.real_name LIKE '%$nama%'";
                $cekFilter = 1;
            }

            //cek filter status ketuntasan
            if($complete != ""){
                if($cekFilter == 0){
                    $query .= " WHERE mm.status_ketuntasan = '$complete'";
                }else{
                    $query .= " AND mm.status_ketuntasan = '$complete'";
                }
            }

            //cek filter nilai akhir
            if($nilai != ""){
                if($cekFilter == 0){
                    $query .= " WHERE mm.nilai_akhir = '$nilai'";
                }else{
                    $query .= " AND mm.nilai_akhir = '$nilai'";
                }
            }

            $queryResult = $this->db->executeSelectQuery($query);

            $result = [];
            foreach($queryResult as $key => $value) {
                $result[] = new CourseReport($value['real_name'], $value['nilai_akhir'], $value['status_ketuntasan'], $value['status_verifikasi'], $value['tanggal_tuntas'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang']);
            }
            return $result;
        }

        public function getCourseReport_filter(){
            $nama = $_GET['name']; 
            $complete = $_GET['complete'];
            $nilai = $_GET['nilai'];
            
            $result = $this->getCourseReport($nama, $complete, $nilai);
            return View::createViewFilter('ajaxCourseReport.php',[
                "result"=>$result
            ]);
        }

        public function getCourseTransactionReport(){
            $query = "SELECT tc.id_transaksi_course, tc.tanggal_transaksi_course,
                            c.tarif, tc.saldo_awal, tc.saldo_akhir,
                            c.nama_course, mm.status_verifikasi
                      FROM pengguna p INNER JOIN member m 
                            ON p.id_pengguna = m.id_pengguna
                            INNER JOIN member_course mm
                            ON mm.id_member = m.id_member
                            INNER JOIN transaksi_course tc
                            ON tc.id_member = m.id_member
                            INNER JOIN courses c 
                            ON c.id_courses = tc.id_courses
                      ORDER BY tc.id_transaksi_course ASC
                     ";
            $queryResult = $this->db->executeSelectQuery($query);
            // var_dump($queryResult);
            // die;
            foreach($queryResult as $key => $value) {
                $result[] = new TransactionCourseReport($value['id_transaksi_course'], $value['tanggal_transaksi_course'], $value['tarif'], $value['saldo_awal'], $value['saldo_akhir'], $value['nama_course'], $value['status_verifikasi']);
            }
            return $result;
        }

        //ambil top-up report 
        public function getTopUpReport(){
            $query = "SELECT id_transaksi_saldo, tanggal_transaksi_saldo, nominal_pengisian, saldo_awal, saldo_akhir, status_verifikasi
                      FROM transaksi_saldo
                      ORDER BY id_transaksi_saldo ASC
                     ";
            $queryResult = $this->db->executeSelectQuery($query);

            foreach($queryResult as $key => $value) {
                $result[] = new TopUpReport($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['status_verifikasi']);
            }
            return $result;
        }
        
        //view course report
        public function view_courseReport(){
            $result = $this->getCourseReport("", "", "");
            return View::createView('reportCourse.php', [
                "result"=>$result
            ]);
        }

        public function view_topUpReport(){
            $result = $this->getTopUpReport();
            return View::createView('reportTopUp.php', [
                "result"=>$result
            ]);
        }

        public function view_courseTransactionReport(){
            $result = $this->getCourseTransactionReport();
            return View::createView('reportCourseTransaction.php', [
                "result"=>$result
            ]);
        }
    }
?>