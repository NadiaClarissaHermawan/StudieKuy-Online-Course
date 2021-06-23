<?php 
    require_once "control/services/viewIndex.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/saldo.php";
    require_once "model/listMemberCourse.php";

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
                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $result[] = new Saldo($value['saldo']);
                }

                //ambil modul" dari course bersangkutan
                return View::createViewCourseDetail('courseModul.php', [
                    "result" => $result
                ]);
            
            //belum login
            }else{
                session_destroy();
                return View::createViewCourseDetail('courseModul.php', []);
            }
            return View::createViewCourseModul('courseModul.php', []);
        }

        public function view_courseExam(){
            return View::createViewCourseExam('courseExam.php', []);
        }
    }
?>