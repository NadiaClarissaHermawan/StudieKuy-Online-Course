<?php 
    session_start();
    require_once "control/services/viewTeacherLoginRegister.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/teacher.php";

    class teacherLoginController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_teacherLoginpage(){
            return View::createView('teacherLogin.php', []);
        }

        public function klik_login(){
            $uname = $_POST['uname'];
            $upass = $_POST['upass'];

            if(isset($uname) && $uname!="" && isset($upass) && $uname!=""){
                $uname = $this->db->escapeString($uname);
                $upass = $this->db->escapeString($upass);
                
                $query = "SELECT p.pass, p.status
                          FROM pengajar m INNER JOIN pengguna p
                          ON m.id_pengguna = p.id_pengguna
                          WHERE m.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE nama_user = '$uname')
                         ";
                $resQuery = $this->db->executeSelectQuery($query);
                $pass_asli = $resQuery[0]['pass'];
                $stat = $resQuery[0]['status'];

                if(empty($pass_asli)){
                    $_SESSION['unameNotFound'] = 0;
                    header('Location: teacherLogin');

                }else if($stat == 0) {
                    $_SESSION['unameNotFound'] = 0;
                    header('Location: teacherLogin');                  
                }else{
                   //password benar
                   if($upass == $pass_asli){
                    $query = "SELECT p.id_pengguna 
                              FROM pengguna p
                              WHERE nama_user = '$uname' AND pass = '$upass'
                            ";
                    $resQuery = $this->db->executeSelectQuery($query);
                    
                    $_SESSION['id_pengguna'] = $resQuery[0]['id_pengguna'];
                    $_SESSION['statusTeacher'] = 1;
                    header('Location: indexTeacher?');

                    //password salah
                    }else{
                        $_SESSION['unameNotFound'] = $uname;
                        header('Location: teacherLogin');
                        die;
                    }
                }
            }
        }

        //logout teacher
        public function logout(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            session_destroy();
            header('Location: teacherLogin');
            die;
        }
    }
?>