<?php 
    session_start();
    require_once "control/services/viewUserProfile.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/member.php";

    class userProfileController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_userProfile(){
            $result = $this->getUserProfile();
            return View::createView('userProfile.php', [
                "result"=>$result
            ]);
        }

        public function getUserProfile(){
            $id = $_SESSION['id_pengguna'];
            $query = "SELECT nama_user, real_name, email, profile_picture, pass, saldo, kontak, alamat
                      FROM pengguna p INNER JOIN member m
                      ON p.id_pengguna = m.id_pengguna
                      WHERE m.id_pengguna = '$id' 
                     ";
            $resQuery = $this->db->executeSelectQuery($query);

            $saldo = 0;
            if($resQuery[0]['saldo'] == '0.000'){
                $saldo = 0;
            }else{
                $saldo = $resQuery[0]['saldo'];
            }

            foreach($resQuery as $key=> $value){
                $result[] = new Member ($value['nama_user'], $value['real_name'], $value['pass'], $value['email'], $value['kontak'], $value['alamat'], $saldo, $value['profile_picture']);
            }
            return $result;
        }

        public function signOut(){
            session_destroy();
            header('Location: index');
        }

        public function view_editProfile(){
            $result = $this->getUserProfile();
            return View::createView('userEditProfile.php', [
                "result"=>$result
            ]);
        }

        //edit profile text info
        public function profileTextEdit(){
            $id_p = $_SESSION['id_pengguna'];
            $uname = $_POST['uname'];
            $urealname = $_POST['urealname'];
            $uaddress = $_POST['uaddress'];
            $uphone = $_POST['uphone'];
            $upass = $_POST['upass'];

            $uname = $this->db->escapeString($uname);
            $urealname = $this->db->escapeString($urealname);
            $uaddress= $this->db->escapeString($uaddress);
            $uphone = $this->db->escapeString($uphone);
            $upass = $this->db->escapeString($upass);

            //update info yg ada di tabel pengguna
            $query = "UPDATE pengguna 
                      SET nama_user = '$uname', real_name = '$urealname', pass = '$upass'
                      WHERE id_pengguna = '$id_p'
                     ";
            $this->db->executeNonSelectQuery($query);

            //update info di tabel member
            $query = "UPDATE member
                      SET kontak = '$uphone', alamat = '$uaddress'
                      WHERE id_pengguna = '$id_p'
                     ";
            $this->db->executeNonSelectQuery($query);
        }
        //____________________________________________________________________________________________________________________________________________

        //ajax upload profile picture
        public function upload(){
            $tempUser = $_SESSION['id_pengguna'];

            if(isset($_FILES["file"])){
                $oldName = $_FILES["file"]["tmp_name"];
                //dirname => naik 1 directory
                //__DIR__ => directory file ini skrg (controller/Controller.php)
                $newName = dirname(__DIR__)."\\view\\images\\profilepicture\\".$tempUser.".jpg";
                if(move_uploaded_file($oldName, $newName)){
                    return '{"result":"success"}';
                    $tempProf = $tempUser.".jpg";
                    $query = "UPDATE pengguna
                              SET profile_picture = '$tempProf';
                              WHERE id_pengguna = $tempUser
                             ";
                    $this->db->executeNonSelectQuery($query);
                    
                }else{
                    return '{"result":"error"}';
                }	
                
            }
        }

        public function delete(){
            $tempUser = $_SESSION['id_pengguna'];
            $query = "UPDATE pengguna SET status = 0; WHERE id_pengguna = $tempUser";
            $this->db->executeNonSelectQuery($query);
            session_destroy();
            header('Location: index');
            die;
        }
    }
?>
