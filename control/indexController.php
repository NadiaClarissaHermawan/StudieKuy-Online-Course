<?php 
    require_once "control/services/viewIndex.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/saldo.php";
    require_once "model/listMemberCourse.php";
    require_once "model/modul.php";
    require_once "model/soalUjian.php";

    class indexController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_mainpage(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $result[] = new Saldo($value['saldo']);
                }
                return View::createView('index.php', [
                    "result" => $result
                ]);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('index.php', []);
            }
        }

        public function view_coursesList(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $saldo[] = new Saldo($value['saldo']);
                }

                //query matkul yg uda diambil user
                $query = "SELECT mc.id_memCourse, mc.id_courses, c.nama_course
                          FROM member_course mc INNER JOIN courses c
                          ON mc.id_courses = c.id_courses
                          WHERE mc.id_member = (SELECT m.id_member 
                                                FROM member m INNER JOIN pengguna p
                                                ON m.id_pengguna = p.id_pengguna
                                                WHERE p.id_pengguna = '$id'
                                                )
                         ";
                $queryResult = $this->db->executeSelectQuery($query);
                $result = [];
                foreach($queryResult as $key =>$value){
                    $result[] = new ListMemberCourse($value['id_memCourse'], $value['id_courses'], $value['nama_course']);
                }
                return View::createViewList('list.php', [
                    "result" => $result
                ], $saldo);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('userLogin.php', []);
            }
        }

        public function view_coursesDetail(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $result[] = new Saldo($value['saldo']);
                }
                return View::createViewCourseDetail('coursesDetail.php', [
                    "result" => $result
                ]);
            
            //belum login
            }else{
                session_destroy();
                return View::createViewCourseDetail('coursesDetail.php', []);
            }
        }

        public function view_bidangCourse(){
            return View::createViewBidangCourse('bidangCourse.php', []);
        }

        public function view_courseModul(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $id_memCourse = $_SESSION['idMemCourse'];

                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $res1[] = new Saldo($value['saldo']);
                }
                $saldo = $res1[0]->getSaldo();

                //ambil direktori modul" dari course bersangkutan
                $query = "SELECT isi_modul, nama_modul, keterangan_modul, nama_course, c.id_courses
                            FROM modul INNER JOIN courses c
                                    ON modul.id_courses = c.id_courses
                            WHERE modul.id_courses = (SELECT id_courses
                                                    FROM member_course
                                                    WHERE id_memCourse = '$id_memCourse'
                                                    )
                            ORDER BY id_modul ASC
                        ";
                
                $resQuery = $this->db->executeSelectQuery($query);
                $result = [];
                foreach($resQuery as $key =>$value){
                    $result[] = new Modul($value['nama_modul'], $value['isi_modul'], $value['keterangan_modul'], $value['nama_course'], $value['id_courses']);
                }

                //cek apakah sudah klik salah satu modul?
                //kalau sudah, ambil sumber video modul
                $sumberModul = "";
                if(isset($_GET['namaModul']) && $_GET['namaModul'] != ""){
                    $namaModul = $_GET['namaModul'];
                    $query = "SELECT isi_modul
                              FROM modul
                              WHERE nama_modul = '$namaModul'
                             ";
                    $sumberModul = $this->db->executeSelectQuery($query);
                    $sumberModul = $sumberModul[0]['isi_modul'];
                }else{
                    $sumberModul = $resQuery[0]['isi_modul'];
                }
                

                return View::createViewCourseModul('courseModul.php', [
                    "result" => $result
                ], $saldo, $sumberModul);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('index.php', []);
            }
        }

        public function view_courseExam(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $id_memCourse = $_SESSION['idMemCourse'];

                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $res1[] = new Saldo($value['saldo']);
                }
                $saldo = $res1[0]->getSaldo();

                //ambil nama course
                $query = "SELECT nama_course 
                          FROM courses
                          WHERE id_courses = (SELECT id_courses 
                                              FROM member_course
                                              WHERE id_memCourse = '$id_memCourse'
                                             )
                         ";
                $namaCourse = $this->db->executeSelectQuery($query);
                $namaCourse = $namaCourse[0]['nama_course'];

                //ambil soal" ujian di course bersangkutan
                $query = "SELECT *
                          FROM soal_ujian 
                          WHERE id_courses = ( SELECT id_courses
                                               FROM member_course
                                               WHERE id_memCourse = '$id_memCourse'
                                             )
                          ORDER BY nomor_soal ASC
                         ";
                $resultQuery = $this->db->executeSelectQuery($query);
                $result = [];
                foreach($resultQuery as $key => $value){
                    $result[] = new SoalUjian($value['id_soal_ujian'], $value['nomor_soal'], $value['soal'], $value['opsi1'], $value['opsi2'], $value['opsi3'], $value['kunci_jawaban'], $value['id_courses']);
                }

                return View::createViewCourseExam('courseExam.php', [
                    "result" => $result
                ], $saldo, $namaCourse);

            }else{
                session_destroy();
                return View::createView('index.php', []);
            }
        }

        public function cekJawaban(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $id_course = $_POST['idCourse'];
            $id_memCourse = $_SESSION['idMemCourse'];

            //ambil kunjaw
            $query = "SELECT *
                      FROM soal_ujian
                      WHERE id_courses = (SELECT id_courses
                                          FROM member_course
                                          WHERE id_memCourse = '$id_memCourse'
                                         )
                      ORDER BY nomor_soal ASC
                     ";
            $resQuery = $this->db->executeSelectQuery($query);
            $benar = 0;
            //cek jawaban benar
            foreach($resQuery as $key => $value){
                if(isset($_POST['opt'.$key]) && $_POST['opt'.$key] == $value['kunci_jawaban']){
                    $benar ++;
                }
            }
            $panjangResQuery = count($resQuery);
            //nilai akhir
            $benar = $benar / $panjangResQuery * 100;

            //update nilai akhir
            $query = "UPDATE member_course
                      SET nilai_akhir = '$benar', tanggal_tuntas = now()
                      WHERE id_memCourse = '$id_memCourse'
                     ";
            $this->db->executeNonSelectQuery($query);

            //tidak timeout
            if($_POST['timeOutStatus'] == 0){
                header('Location: progress');
            }else{
                header('Location: timeOut');
            }
        }
    }
?>