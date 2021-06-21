<?php 
    // session_start();
    require_once "control/services/viewIndexTeacher.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/teacher.php";

    class indexTeacherController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_mainpageTeacher(){
            return View::createView('indexTeacher.php', []);
        }
    }
    class createCourseController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_createCoursePage(){
            return View::createViewCreateCourse('createCourse.php', []);
        }
    }
    class uploadModulController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_uploadModul(){
            return View::createViewUploadModul('uploadModul.php', []);
        }
    }
    class createExamController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_createExam(){
            return View::createViewCreateExam('createExam.php', []);
        }
    }
    class teacherCourseController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_teacherCourse(){
            return View::createViewTeacherCourse('teacherCourse.php', []);
        }
    }

    class teacherProfileController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_teacherProfile(){
            $result = $this->getTeacherProfile();
            return View::createViewTeacherProfile('teacherProfile.php', [
                "result"=>$result
            ]);
        }

        // Database teacher belum terupdate. Masih kurang utk alamat, kota, save bukti pendidikan terakhir(ijasah), phone number blm
        public function getTeacherProfile(){
            $id = $_SESSION['id_pengguna'];
            $query = "SELECT u.real_name, u.nama_user, u.email, u.pass, p.pendidikan_terakhir, u.profile_picture 
                      FROM pengguna u INNER JOIN pengajar p
                      ON u.id_pengguna = p.id_pengguna
                      WHERE p.id_pengguna = '$id' 
                     ";
            $resQuery = $this->db->executeSelectQuery($query);

            foreach($resQuery as $key=> $value){
                $result[] = new Teacher ($value['real_name'], $value['name_user'], $value['email'], $value['pass'], $value['pendidikan_terakhir'], $value['profile_picture']);
            }
            return $result;
        }

        public function signOut(){
            session_destroy();
            header('Location: indexTeacher');
        }

        public function view_editProfile(){
            $result = $this->getTeacherProfile();
            return View::createView('teacherEditProfile.php', [
                "result"=>$result
            ]);
        }

        //edit profile text info
        public function profileTextEdit(){
            $id_p = $_SESSION['id_pengguna'];
            $urealname = $_POST['urealname'];
            $uname = $_POST['uname'];
            $upass = $_POST['upass'];

            $urealname = $this->db->escapeString($urealname);
            $uname = $this->db->escapeString($uname);
            $upass = $this->db->escapeString($upass);

            //update info yg ada di tabel pengguna
            $query = "UPDATE pengguna 
                      SET nama_user = '$uname', real_name = '$urealname', pass = '$upass'
                      WHERE id_pengguna = '$id_p'
                     ";
            $this->db->executeNonSelectQuery($query);
        }
        //____________________________________________________________________________________________________________________________________________

        //test ajax upload profile picture
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
    }
?>