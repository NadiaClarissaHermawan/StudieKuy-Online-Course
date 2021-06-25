<?php 
    // session_start();
    require_once "control/services/viewIndexTeacher.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/teacher.php";
    require_once "model/courseTeacher.php";

    class indexTeacherController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_mainpageTeacher(){
            //ambil semua keterangan teacher

            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login
            if(isset($_SESSION['statusTeacher'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT u.real_name, u.nama_user, u.email, u.pass, t.pendidikan_terakhir, u.profile_picture, t.alamat, t.kontak
                        FROM pengajar t INNER JOIN pengguna u
                        ON t.id_pengguna = u.id_pengguna
                        WHERE t.id_pengguna = '$id'
                        ";
                $teach = $this->db->executeSelectQuery($query);
                foreach($teach as $key =>$value){
                    $result[] = new Teacher($value['real_name'], $value['nama_user'], $value['email'], $value['pass'], $value['pendidikan_terakhir'], $value['profile_picture'], $value['alamat'], $value['kontak']);
                }

                return View::createView('indexTeacher.php', [
                    "result" => $result 
                ]);
            //belum login
            }else{
                session_destroy();
                return View::createView('teacherLogin.php', []);
            }
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

        public function insertCourse(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login

            if(isset($_SESSION['statusTeacher'])){
                $id = $_SESSION['id_pengguna'];
                
                $name = $_POST['courseName'];
                $category = $_POST['courseCat'];
                $desc = $_POST['courseDesc'];
                $cost = $_POST['courseCost'];
                $kkm = $_POST['courseKKM'];
                $gbr = $_FILES["file"];

                $name = $this->db->escapeString($name);
                $desc = $this->db->escapeString($desc);

                //cari id teacher
                $query = "SELECT t.id_pengajar
                        FROM pengajar t INNER JOIN pengguna u
                        ON t.id_pengguna = u.id_pengguna
                        WHERE t.id_pengguna = '$id'
                        ";
                $idT = $this->db->executeSelectQuery($query);
                $query = "INSERT INTO courses (nama_course, tarif, batas_nilai_minimum, keterangan_course, id_pengajar, gambar_courses) VALUES ('$name', '$cost', '$kkm', '$desc', '$idT', '$gbr')";
                $this->db->executeNonSelectQuery($query);;
            //belum login
            }else{
                session_destroy();
                return View::createView('teacherLogin.php', []);
            }
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

        //tambahin modul yg sdh di create --> kacau
        public function addModul(){
            var_dump($_POST);
            var_dump($_FILES);
            die;
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

        //show all course yg udah dbikin teacher
        public function view_teacherCourse(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $id_pengguna = $_SESSION['id_pengguna'];
            $query = "SELECT id_courses, nama_course, tarif, batas_nilai_minimum, keterangan_course, gambar_courses
                      FROM courses
                      WHERE id_pengajar = (SELECT id_pengajar FROM pengajar WHERE id_pengguna = '$id_pengguna')
                     ";
            $resQuery = $this->db->executeSelectQuery($query);

            foreach($resQuery as $key => $value){
                $result[] = new CourseTeacher($value['id_courses'], $value['nama_course'], $value['tarif'], $value['batas_nilai_minimum'], $value['keterangan_course'], $value['gambar_courses']);
            }

            return View::createViewTeacherCourse('teacherCourse.php', [
                "result"=>$result
            ]);
        }

        public function view_teacherCourseModul(){
            return View::createViewTeacherModul('teacherModul.php', []);
        }
        public function view_teacherCourseExam(){
            return View::createViewTeacherExam('teacherExam.php', []);
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

        public function getTeacherProfile(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['statusTeacher']) && $_SESSION['statusTeacher'] != ""){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT u.real_name, u.nama_user, u.email, u.pass, p.pendidikan_terakhir, u.profile_picture 
                          FROM pengguna u INNER JOIN pengajar p
                          ON u.id_pengguna = p.id_pengguna
                          WHERE p.id_pengguna = '$id' 
                        ";
                $resQuery = $this->db->executeSelectQuery($query);
                
                foreach($resQuery as $key=> $value){
                    $result = new Teacher ($value['real_name'], $value['nama_user'], $value['email'], $value['pass'], $value['pendidikan_terakhir'], $value['profile_picture']);
                }
<<<<<<< Updated upstream
                return $result;
                // return View::createViewTeacherProfile('teacherProfile.php', [
                //     "result"=>$result
                // ]);
=======
                
                return $result;
>>>>>>> Stashed changes

            //belum login
            }else{
                session_destroy();
                header('Location: teacherLogin');
            }
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