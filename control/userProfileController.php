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
            return View::createView('userProfile.php', []);
        }

        public function signOut(){
            session_destroy();
            header('Location: index');
        }

        public function view_editProfile(){
            return View::createView('userEditProfile.php', []);
        }

        public function editProfile(){
            if(isset($_FILES["foto"])){
                $oldName = $_FILES["foto"]["tmp_name"];
                $newName = dirname(__DIR__)."\\view\\images\\profilepicture\\".$_SESSION['id_pengguna'].'.jpg';
                //$_FILES["foto"]["type"] == 'image/jpg'
                if(move_uploaded_file($oldName, $newName)){
                    $data = file_get_contents($newName);
                    // echo json_decode([true, 'data:image/jpg;base64, '.base64_encode($data)]);
                    $this->uploadFoto();
                }
            }
        }

        public function uploadFoto(){
            $userId = $_SESSION['id_pengguna'].'.jpg';
            $id_pengguna = $_SESSION['id_pengguna'];
            $_SESSION['profpic'] = $userId;

            $query = "UPDATE pengguna SET profile_picture = '$userId' WHERE id_pengguna = '$id_pengguna'";
            $this->db->executeNonSelectQuery($query);
        }
    }
?>
