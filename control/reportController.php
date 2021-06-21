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
        public function getCourseReport(){
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
                      ORDER BY p.real_name ASC
                     ";
            $queryResult = $this->db->executeSelectQuery($query);

            foreach($queryResult as $key => $value) {
                $result[] = new CourseReport($value['real_name'], $value['nilai_akhir'], $value['status_ketuntasan'], $value['status_verifikasi'], $value['tanggal_tuntas'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang']);
            }
            return $result;
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
            $result = $this->getCourseReport();
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

        //filtering course report
        public function filterReportCourse(){
            $filterNama = $_GET['filterName'];
            $filterCompleteStatus = $_GET['filterCompleteStatus'];
            $filterFinalScore = $_GET['filterFinalScore'];

            //kalau ketiga filter terisi
            if(isset($filterNama) && $filterNama != "" && isset($filterCompleteStatus) && $filterCompleteStatus != "" && isset($filterFinalScore) && $filterFinalScore != ""){
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
                            WHERE p.real_name LIKE '%$filterNama%' 
                                AND mm.status_ketuntasan = '$filterCompleteStatus'
                                AND mm.nilai_akhir = '$filterFinalScore'
                            ORDER BY p.real_name ASC
                          ";
                $queryRes = $this->db->executeSelectQuery($query);
                foreach($queryRes as $key => $value) {
                    $result[] = new CourseReport($value['real_name'], $value['nilai_akhir'], $value['status_ketuntasan'], $value['status_verifikasi'], $value['tanggal_tuntas'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang']);
                }
                return $result;
                

            //filter nama & complete status
            }else if(isset($filterNama) && $filterNama != "" && isset($filterCompleteStatus) && $filterCompleteStatus != ""){

            //filter nama & final score
            }else if(isset($filterNama) && $filterNama != "" && isset($filterFinalScore) && $filterFinalScore!=""){

            //filter complete status & final score 
            }else if(isset($filterCompleteStatus) && $filterCompleteStatus != "" && isset($filterFinalScore) && $filterFinalScore!=""){

            //filter nama
            }else if(isset($filterNama) && $filterNama != ""){

            //filter complete status
            }else if(isset($filterCompleteStatus) && $filterCompleteStatus != ""){

            //filter filter final score
            }else if(isset($filterFinalScore) && $filterFinalScore!=""){

            //filter kosong
            }else{

            }
        }
    }
?>