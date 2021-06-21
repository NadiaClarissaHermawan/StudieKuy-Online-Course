<?php 
    require_once "control/services/viewReport.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/CourseReport.php";
    require_once "model/TopUpReport.php";

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

        public function view_courseReport(){
            $result = $this->getCourseReport();
            return View::createView('reportCourse.php', [
                "result"=>$result
            ]);
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

        public function view_topUpReport(){
            $result = $this->getTopUpReport();
            return View::createView('reportTopUp.php', [
                "result"=>$result
            ]);
        }

        public function view_courseTransactionReport(){
            return View::createView('reportCourseTransaction.php', []);
        }
    }
?>