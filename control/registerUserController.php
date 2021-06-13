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

        public function klik_register(){
            $username = $_POST['uname'];
            $password = $_POST['upass'];
            $email = $_POST['uemail'];
            $phone = $_POST['uphone'];
            $address = $_POST['uaddress'];
            $kota = $_POST['ucity'];

            if(isset($_POST['registerButton']) && isset($username) && $username!=""
            && isset($password) && $password!= "" && isset($email) && $email !="" 
            && isset($phone) && $phone!= "" && isset($address) && $address!= "" && isset($kota) && $kota!=""){

                $username = $this->db->escapeString($username);
                $password = $this->db->escapeString($password);
                $email = $this->db->escapeString($email);
                $phone = $this->db->escapeString($phone);
                $address = $this->db->escapeString($address);
                $kota = $this->db->escapeString($kota);

                $query = "SELECT id_pengguna FROM Pengguna WHERE nama_user = '$username' OR email = '$email'";
                $adaTidak = $this->db->executeSelectQuery($query);
                
                //kalau username sudah terdaftar
                if(empty($adaTidak) == false){
                    var_dump("username sudah terdaftar");
                //kalau username belum terdaftar
                }else{
                    $query = "INSERT INTO pengguna (tipe, nama_user, email, password) VALUES (3, '$username', '$email','$password')";
                    $this->db->executeNonSelectQuery($query);

                    $query = "SELECT id_pengguna FROM pengguna WHERE nama_user = '$username' AND password = '$password' AND email = '$email'";
                    $id_pengguna = $this->db->executeSelectQuery($query);

                    $query = "SELECT id_kota FROM kota WHERE nama_kota = '$kota'";
                    $id_kota = $this->db->executeSelectQuery($query);

                    $query = "INSERT INTO member (saldo, kontak, alamat, id_kota, id_pengguna) VALUES (0, '$phone', '$address','$id_kota', $id_pengguna)";
                    $this->db->executeNonSelectQuery($query);

                    header('Location: index');
                    die;
                }
            }
        }
    }
?>