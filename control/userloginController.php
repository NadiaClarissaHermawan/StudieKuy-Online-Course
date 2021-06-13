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

                $query = "SELECT password FROM pengguna WHERE nama_user = '$uname'";
                $pass_asli = $this->db->executeSelectQuery($query);

                //kalo username tdk tercantum di database
                if(empty($pass_asli)){
                    session_destroy();
                    //javascript ngasih tau akun tidak ditemukan

                }else{
                    //password benar -> simpan semua data diri user
                    if($upass == $pass_asli[0]['password']){
                        $query = "SELECT email, kontak, alamat, saldo 
                                  FROM member m INNER JOIN pengguna p
                                  ON m.id_pengguna = p.id_pengguna
                                  WHERE nama_user = '$uname' AND password = '$upass'
                                ";
                        $resQuery = $this->db->executeSelectQuery($query);

                        var_dump($resQuery);
                        die;
                        $_SESSION['user'] = new Member($uname, $upass, $email, $phone, $address, $saldo);

                    //password salah
                    }else{
                        session_destroy();
                        //javascript ngasih tau salah password

                    }
                }
            }
        }
    }
?>