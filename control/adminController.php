<?php 
    session_start();
    require_once "control/services/viewAdmin.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/admin.php";
    // require_once "model/member.php";

    class adminController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_adminLoginpage(){
            return View::createView('adminLogin.php', []);
        }

        public function klik_login(){
            $uname = $_POST['uname'];
            $upass = $_POST['upass'];

            if(isset($uname) && $uname!="" && isset($upass) && $uname!=""){
                $uname = $this->db->escapeString($uname);
                $upass = $this->db->escapeString($upass);
                
                $query = "SELECT p.pass
                          FROM admin a INNER JOIN pengguna p
                          ON a.id_pengguna = p.id_pengguna
                          WHERE a.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE nama_user = '$uname')
                         ";
                $pass_asli = $this->db->executeSelectQuery($query);

                //kalo username tdk tercantum di tabel ADMIN
                if(empty($pass_asli)){
                    $_SESSION['unameNotFound'] = 0;
                    header('Location: adminLogin');

                }else{
                    //password benar
                    if($upass == $pass_asli[0]['pass']){
                        $query = "SELECT p.id_pengguna 
                                  FROM pengguna p
                                  WHERE nama_user = '$uname' AND pass = '$upass'
                                ";
                        $resQuery = $this->db->executeSelectQuery($query);
                        
                        $_SESSION['id_pengguna'] = $resQuery[0]['id_pengguna'];
                        $_SESSION['statusAdmin'] = 2;
                        header('Location: indexAdmin');

                    //password salah
                    }else{
                        $_SESSION['unameNotFound'] = $uname;
                        header('Location: adminLogin');
                    }
                }
            }
        }

        public function getAdminProfile(){
            $adminId = $_SESSION['id_pengguna'];
            $query ="SELECT nama_user, real_name, email, profile_picture, pass
                     FROM pengguna 
                     WHERE id_pengguna = '$adminId' 
                    ";
            $resQuery = $this->db->executeSelectQuery($query);
            
            foreach($resQuery as $key=>$value){
                $result[] = new Admin ($value['nama_user'], $value['real_name'], $value['pass'], $value['email'], $value['profile_picture']);
            }
            return $result;
        }

        //main page admin
        public function view_mainpageAdmin(){
            $result = $this->getAdminProfile();
            return View::createViewMainPageAdmin('indexAdmin.php', [
                "result" => $result
            ]);
        }

        //logout
        public function logout(){
            session_destroy();
            header('Location: adminLogin');
            die;
        }
    }
?>