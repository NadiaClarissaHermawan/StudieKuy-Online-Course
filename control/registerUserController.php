<?php 
    require_once "control/services/viewUserLoginRegister.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/kota.php";

    class registerUserController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_registerUserPage(){
            $result = $this->getAllKota();
            return View::createView('userRegister.php', [
                "result"=>$result
            ]);
        }

        public function view_registerTeacherUserPage(){
            $result = $this->getAllKota();
            return View::createView('userTeacherRegister.php', [
                "result"=>$result
            ]);
        }

        public function getAllKota(){
            $query = "  SELECT id_kota, nama_kota
                        FROM kota
                     ";
            $query_result = $this->db->executeSelectQuery($query);
            $result = [];
            foreach($query_result as $key => $value){
                $result[] = new Kota( $value['id_kota'], $value['nama_kota']);
            }
            return $result;
        }

        public function klik_register(){
            $username = $_POST['uname'];
            $realname = $_POST['urealname'];
            $password = $_POST['upass'];
            $email = $_POST['uemail'];
            $phone = $_POST['uphone'];
            $address = $_POST['uaddress'];
            $kota = $_POST['ucity'];

            //cek validitas input
            if(isset($_POST['registerButton']) && isset($username) && $username!=""
            && isset($password) && $password!= "" && isset($email) && $email !="" 
            && isset($phone) && $phone!= "" && isset($address) && $address!= "" && isset($kota) && $kota!=""
            && isset($realname) && $realname!=""){

                $username = $this->db->escapeString($username);
                $realname = $this->db->escapeString($realname);
                $password = $this->db->escapeString($password);
                $email = $this->db->escapeString($email);
                $phone = $this->db->escapeString($phone);
                $address = $this->db->escapeString($address);
                $kota = $this->db->escapeString($kota);

                $query = "SELECT id_pengguna FROM Pengguna WHERE nama_user = '$username' OR email = '$email'";
                $adaTidak = $this->db->executeSelectQuery($query);
                
                //kalau username sudah terdaftar
                if(empty($adaTidak) == false){
                    //JS biar ga redirecting tp muncul notif uname gaada
                    var_dump("username sudah terdaftar");
                    die;

                //kalau username belum terdaftar
                }else{
                    $profpic = "baseProfilePic.jpg";
                    $query = "INSERT INTO pengguna (tipe, nama_user, real_name, email, pass, profile_picture) VALUES (3, '$username', '$realname' ,'$email','$password', '$profpic')";
                    $this->db->executeNonSelectQuery($query);

                    $query = "SELECT id_pengguna FROM pengguna WHERE nama_user = '$username' AND pass = '$password' AND email = '$email'";
                    $id_pengguna = $this->db->executeSelectQuery($query);
                    $id_pengguna = $id_pengguna[0]['id_pengguna'];

                    $query = "INSERT INTO member (saldo, kontak, alamat, id_kota, id_pengguna) VALUES (0, '$phone', '$address','$kota', '$id_pengguna')";
                    $this->db->executeNonSelectQuery($query);

                    header('Location: userLogin');
                    die;
                }
            }
        }
    }
?>