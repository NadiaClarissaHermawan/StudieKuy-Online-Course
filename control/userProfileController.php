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

        public function editProfile(){
            if(isset($_FILES["foto"])){
                $oldName = $_FILES["foto"]["tmp_name"];
                $newName = dirname(__DIR__)."\\view\\images\\profilepicture\\".$_SESSION['id_pengguna'].'.jpg';
                //$_FILES["foto"]["type"] == 'image/jpg'
                if(move_uploaded_file($oldName, $newName)){
                    $data = file_get_contents($newName);
                    // echo json_decode([true, 'data:image/jpg;base64, '.base64_encode($data)]);
                    $this->upload();
                }
            }
        }

        //ini upload profile picture baru
        public function upload(){
            $tempUser = $_SESSION['id_pengguna'];

            if(isset($_FILES["file"])){
                $oldName = $_FILES["file"]["tmp_name"];
                //dirname => naik 1 directory
                //__DIR__ => directory file ini skrg (controller/Controller.php)
                $newName = dirname(__DIR__)."\\view\\images\\profilepicture\\".$tempUser.".jpg";
                if(move_uploaded_file($oldName, $newName)){
                    printf("File [%s] has successfully uploaded to [%s]",$oldName, $newName);
                    $query = "UPDATE pengguna
                              SET profile_picture = '$tempUser'.'.jpg';
                              WHERE id_pengguna = $tempUser
                             ";
                    $this->db->executeNonSelectQuery($query);
                    
                }else{
                    echo "Error in uploading";
                }	
                
            }
        }
    }
?>
