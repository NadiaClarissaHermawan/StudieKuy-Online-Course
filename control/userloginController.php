<?php 
    require_once "control/services/viewUserLoginRegister.php";
    require_once "control/services/mysqlDB.php";

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
                    //javascript ngasih tau akun tidak ditemukan

                }else{
                    //password benar
                    if($upass == $pass_asli[0]['password']){
                        header('Location: index?status=1');
                        die;

                    //password salah
                    }else{
                        //javascript ngasih tau salah password
                        
                    }
                }
            }
        }
    }
?>