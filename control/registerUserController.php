<?php 
    require_once "control/services/viewUserLoginRegister.php";
    require_once "control/services/mysqlDB.php";

    class registerUserController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_registerUserPage(){
            return View::createView('userRegister.php', []);
        }

        public function view_registerTeacherUserPage(){
            return View::createView('userTeacherRegister.php', []);
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
                    $query = "INSERT INTO pengguna (tipe, nama_user, real_name, email, pass) VALUES (3, '$username', '$realname' ,'$email','$password')";
                    $this->db->executeNonSelectQuery($query);

                    $query = "SELECT id_pengguna FROM pengguna WHERE nama_user = '$username' AND pass = '$password' AND email = '$email'";
                    $id_pengguna = $this->db->executeSelectQuery($query);
                    $id_pengguna = $id_pengguna[0]['id_pengguna'];

                    $query = "SELECT id_kota FROM kota WHERE nama_kota = '$kota'";
                    $id_kota = $this->db->executeSelectQuery($query);
                    $id_kota = $id_kota[0]['id_kota'];

                    $query = "INSERT INTO member (saldo, kontak, alamat, id_kota, id_pengguna) VALUES (0, '$phone', '$address','$id_kota', '$id_pengguna')";
                    $this->db->executeNonSelectQuery($query);

                    header('Location: userLogin');
                    die;
                }
            }
        }
    }
?>