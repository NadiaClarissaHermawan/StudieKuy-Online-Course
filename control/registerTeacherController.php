<?php
    require_once "control/services/viewTeacherRegister.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/kota.php";

    class registerTeacherController{
        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
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
            $diploma = $_POST['udiploma'];

            $username = $this->db->escapeString($username);
            $realname = $this->db->escapeString($realname);
            $password = $this->db->escapeString($password);
            $email = $this->db->escapeString($email);
            $phone = $this->db->escapeString($phone);
            $address = $this->db->escapeString($address);
            $kota = $this->db->escapeString($kota);
            $diploma = $this->db->escapeString($diploma);

            //cek validitas input
            if(isset($_POST['registerButton']) && isset($username) && $username!="" 
            && isset($password) && $password!= "" && isset($email) && $email !="" 
            && isset($phone) && $phone!= "" && isset($address) && $address!= "" && isset($kota) && $kota!=""
            && isset($realname) && $realname!=""&& isset($diploma) && $diploma!=""){

                //cek apakah uname & email sdh ada ato blm
                $queryUname = "SELECT id_pengguna
                        FROM pengguna
                        WHERE nama_user = '$username'
                        ";
                $resQueryUname = $this->db->executeSelectQuery($queryUname);
                $queryEmail = "SELECT id_pengguna
                                FROM pengguna
                                WHERE email = '$email'
                            ";
                $resQueryEmail = $this->db->executeSelectQuery($queryEmail);

                //belum ada
                if(empty($resQueryUname) && empty($resQueryEmail)){
                    $profpic = "baseProfilePic.jpg";
                    $query = "INSERT INTO pengguna (tipe, nama_user, real_name, email, pass, profile_picture, status) VALUES (2, '$username', '$realname' ,'$email','$password', '$profpic', 1)";
                    $this->db->executeNonSelectQuery($query);

                    $query = "SELECT id_pengguna FROM pengguna WHERE nama_user = '$username' AND pass = '$password' AND email = '$email'";
                    $id_pengguna = $this->db->executeSelectQuery($query);
                    $id_pengguna = $id_pengguna[0]['id_pengguna'];

                    $query = "INSERT INTO pengajar (pendidikan_terakhir, id_pengguna) VALUES ('$diploma', '$id_pengguna')";
                    $this->db->executeNonSelectQuery($query);

                    header('Location: teacherLogin');
                    die;
                
                //ada duplikasi
                }else{
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    var_dump($resQueryEmail);
                    var_dump($resQueryUname);

                    //both duplicate
                    if(!empty($resQueryUname) && !empty($resQueryEmail)){
                        $_SESSION['duplicate'] = "0";

                    //uname duplicate
                    }else if(!empty($resQueryUname)){
                        $_SESSION['duplicate'] = "00";
                    
                    //email duplicate
                    }else if(!empty($resQueryEmail)){
                        $_SESSION['duplicate'] = "000";
                    }
                    header('Location: userTeacherRegister');
                    die;
                }
            }
        }
    }
?>