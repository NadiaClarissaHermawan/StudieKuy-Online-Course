<?php 
    session_start();
    require_once "control/services/viewUserLoginRegister.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/member.php";

    class userLoginController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_userLoginpage(){
            return View::createView('userLogin.php', []);
        }

        public function klik_login(){
            $uname = $_POST['uname'];
            $upass = $_POST['upass'];

            if(isset($uname) && $uname!="" && isset($upass) && $uname!=""){
                $uname = $this->db->escapeString($uname);
                $upass = $this->db->escapeString($upass);
                
                $query = "SELECT p.pass, p.status
                          FROM member m INNER JOIN pengguna p
                          ON m.id_pengguna = p.id_pengguna
                          WHERE m.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE nama_user = '$uname')
                         ";
                $resQuery = $this->db->executeSelectQuery($query);
                $pass_asli = $resQuery[0]['pass'];
                $stat = $resQuery[0]['status'];

                //kalo username tdk tercantum di tabel MEMBER 
                if(empty($pass_asli)){
                    $_SESSION['unameNotFound'] = 0;
                    header('Location: userLogin');
                }else if($stat == 0) {
                    $_SESSION['unameNotFound'] = 0;
                    header('Location: userLogin');                    
                }else{
                    //password benar
                    if($upass == $pass_asli){
                        $query = "SELECT p.id_pengguna 
                                  FROM pengguna p
                                  WHERE nama_user = '$uname' AND pass = '$upass'
                                ";
                        $resQuery = $this->db->executeSelectQuery($query);
                        
                        $_SESSION['id_pengguna'] = $resQuery[0]['id_pengguna'];
                        $_SESSION['status'] = 1;
                        header('Location: index?status=1');

                    //password salah
                    }else{
                        $_SESSION['unameNotFound'] = $uname;
                        header('Location: userLogin');
                    }
                }
            }
        }
    }
?>