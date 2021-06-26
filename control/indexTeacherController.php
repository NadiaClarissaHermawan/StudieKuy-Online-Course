<?php 
    // session_start();
    require_once "control/services/viewIndexTeacher.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/teacher.php";
    require_once "model/courseTeacher.php";
    require_once "model/modul.php";
    require_once "model/soalUjian.php";

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

        //bikin keterangan awal course
        public function insertCourse(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login

            if(isset($_SESSION['statusTeacher'])){
                $id = $_SESSION['id_pengguna'];
                
                $name = $_POST['courseName'];
                $category = $_POST['optVal'];
                $desc = $_POST['courseDesc'];
                $cost = $_POST['courseCost'] / 1000;
                $kkm = $_POST['courseKKM'];
                $gbr = $_FILES['courseImgx'];

                $name = $this->db->escapeString($name);
                $desc = $this->db->escapeString($desc);

                //cari id teacher
                $query = "SELECT t.id_pengajar
                        FROM pengajar t INNER JOIN pengguna u
                        ON t.id_pengguna = u.id_pengguna
                        WHERE t.id_pengguna = '$id'
                        ";
                $idT = $this->db->executeSelectQuery($query)[0]['id_pengajar'];
                
                //add new course
                $query = "INSERT INTO courses (nama_course, tarif, batas_nilai_minimum, keterangan_course, id_pengajar, gambar_courses) VALUES ('$name', '$cost', '$kkm', '$desc', '$idT', 'empty.jpg')";
                $this->db->executeNonSelectQuery($query);

                //ambil id_course baru 
                $query = "SELECT id_courses
                          FROM courses
                          WHERE nama_course = '$name'
                         ";
                $id_course = $this->db->executeSelectQuery($query)[0]['id_courses'];

                //move gambar ke direktori, rename & update gambar_courses di tabel courses
                if(isset($gbr)){
                    $oldName = $gbr["tmp_name"];
                    //dirname => naik 1 directory
                    //__DIR__ => directory file ini skrg (controller/Controller.php)
                    $newName = dirname(__DIR__)."\\view\\images\\gambarcourses\\".$id_course.".jpg";
                    if(move_uploaded_file($oldName, $newName)){
                        $tempProf = $id_course.".jpg";
                        $query = "UPDATE courses
                                SET gambar_courses = '$tempProf'
                                WHERE id_courses = $id_course
                                ";
                        $this->db->executeNonSelectQuery($query);
                        header('Location: uploadModul?id='.$id_course.'');
                        
                    }else{
                        return '{"result":"error"}';
                    }	
                }

                //update bidang course
                $query = "INSERT INTO bidang_course (id_bidang, id_courses) VALUES ($category, $id_course)";
                $this->db->executeNonSelectQuery($query);
                header('Location: uploadModul?id_courses='.$id_course);
                die;

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

        //tambahin modul yg sdh di create
        public function addModul(){
            // var_dump($_POST);
            // var_dump($_FILES);
            $id_courses = $_POST['id_courses'];
            //dua var dibawah = array of input
            $namaModul = $_POST;
            $video = $_FILES;

            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sdh login
            if(isset($_SESSION['statusTeacher']) && $_SESSION['statusTeacher']!=""){
                $nomor = 1;
                foreach($namaModul as $key){
                    //kalo bukan id_courses
                    if($key != $id_courses){
                        //cari id_modul yg masih kosong slotnya
                        $query = "SELECT id_modul
                                  FROM modul
                                  ORDER BY id_modul DESC
                                 ";
                        $id_modul = $this->db->executeSelectQuery($query)[0]['id_modul'] + 1;
                        $isi_modul = $id_modul.'.mp4';

                        //insert new modul
                        $query = "INSERT INTO modul (isi_modul, nama_modul, id_courses)
                                  VALUES ('$isi_modul', '$key', '$id_courses')
                                 ";
                        $this->db->executeNonSelectQuery($query);

                        //pindahin video yg diupload ke direktori
                        if(isset($video['video'.$nomor])){
                            $oldName = $video['video'.$nomor]["tmp_name"];
                            //dirname => naik 1 directory
                            //__DIR__ => directory file ini skrg (controller/Controller.php)
                            $newName = dirname(__DIR__)."\\view\\modul\\".$id_modul.".mp4";
                            if(move_uploaded_file($oldName, $newName)){
                                header('Location: createExam?id_courses='.$id_courses);
                                
                            }else{
                                return '{"result":"upload modul error", mohon masukan file yang valid}';
                            }	
                        }

                        $nomor ++;
                    }
                }

            }else{
                session_destroy();
                header('Location: teacherLogin');
                die;
            }
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

        //delete smua yg tadi" udah dibikin & batal
        public function batalBikin(){
            $id_courses = $_GET['id_courses'];
            
            //delete modulnya
            $query = "DELETE FROM modul
                      WHERE id_courses = $id_courses
                     ";
            $this->db->executeNonSelectQuery($query);

            //delete coursenya
            $query = "DELETE FROM courses
                      WHERE id_courses = $id_courses
                     ";
            $this->db->executeNonSelectQuery($query);

            header('Location: indexTeacher');
            die;
        }

        //fix jadi bikin course --> tinggal add exam & sertif name
        public function bikin(){
            $id_courses = $_POST['id_courses'];
            $arrayAll = $_POST;

            //loop per nomor
            for($i = 1; $i<=count($arrayAll)/5; $i++){
                //cari questionnya
                if(isset($arrayAll['q'.$i])){
                    $question = $arrayAll['q'.$i];
                }

                //cari opsi1
                if(isset($arrayAll['q'.$i.'opt1'])){
                    $opsi1 = $arrayAll['q'.$i.'opt1']; 
                }

                //cari opsi2
                if(isset($arrayAll['q'.$i.'opt2'])){
                    $opsi2 = $arrayAll['q'.$i.'opt2']; 
                }

                //cari opsi3
                if(isset($arrayAll['q'.$i.'opt3'])){
                    $opsi3 = $arrayAll['q'.$i.'opt3']; 
                }

                //cari kunjawnya
                if(isset($arrayAll['q'.$i.'kunjaw'])){
                    $kunjaw = $arrayAll['q'.$i.'kunjaw'];
                }

                $query = "INSERT INTO soal_ujian (nomor_soal, soal, opsi1, opsi2, opsi3, kunci_jawaban, id_courses)
                          VALUES ($i, '$question', '$opsi1', '$opsi2', '$opsi3', $kunjaw, $id_courses)
                         ";
                $this->db->executeNonSelectQuery($query);
            }

            //bikin sertif
            $query = "INSERT INTO sertifikat (nama_sertif, id_courses)
                      VALUES((SELECT nama_course FROM courses WHERE id_courses=$id_courses), $id_courses)
                     ";
            $this->db->executeNonSelectQuery($query);
            
            header('Location: courseCreated');
            die;
        }

        public function created(){
            return View::createViewCreateExam('courseCreated.php', []);
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
            $query = "SELECT c.id_courses, nama_course, tarif, batas_nilai_minimum, keterangan_course, gambar_courses, count(id_member) as 'jmlh'
                      FROM courses c INNER JOIN member_course mc ON c.id_courses = mc.id_courses
                      WHERE id_pengajar = (SELECT id_pengajar FROM pengajar WHERE id_pengguna = '$id_pengguna')
                      GROUP BY id_courses
                      ORDER BY id_courses ASC
                     ";
            $resQuery = $this->db->executeSelectQuery($query);
            foreach($resQuery as $key => $value){
                $result[] = new CourseTeacher($value['id_courses'], $value['nama_course'], $value['tarif'], $value['batas_nilai_minimum'], $value['keterangan_course'], $value['gambar_courses'], $value['jmlh']);
            }

            return View::createViewTeacherCourse('teacherCourse.php', [
                "result"=>$result
            ]);
        }

        public function view_teacherCourseModul(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['statusTeacher'])){
                $id = $_SESSION['id_pengguna'];
                $idCourse = $_GET['course'];
                //ambil direktori modul" dari course bersangkutan
                $query = "SELECT isi_modul, nama_modul, nama_course, c.id_courses
                          FROM modul INNER JOIN courses c
                          ON modul.id_courses = c.id_courses
                          WHERE modul.id_courses = $idCourse
                          ORDER BY id_modul ASC
                        ";
                
                $resQuery = $this->db->executeSelectQuery($query);
                $result = [];
                foreach($resQuery as $key =>$value){
                    $result[] = new Modul($value['nama_modul'], $value['isi_modul'], $value['nama_course'], $value['id_courses']);
                }

                //cek apakah sudah klik salah satu modul?
                //kalau sudah, ambil sumber video modul
                $sumberModul = "";
                $selectedModulName = "";
                if(isset($_GET['namaModul']) && $_GET['namaModul'] != ""){
                    $namaModul = $_GET['namaModul'];
                    $query = "SELECT isi_modul
                              FROM modul
                              WHERE nama_modul = '$namaModul'
                             ";
                    $sumberModul = $this->db->executeSelectQuery($query);
                    $sumberModul = $sumberModul[0]['isi_modul'];
                    $selectedModulName = $namaModul;

                //kalau ga, ambil & pick video pertama
                }else{
                    $sumberModul = $resQuery[0]['isi_modul'];
                }
                
                return View::createViewTeacherModul('teacherModul.php', [
                    "result" => $result
                ], $sumberModul, $selectedModulName);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('indexTeacher.php', []);
            }
        }
        
        public function view_teacherCourseExam(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['statusTeacher'])){
                $id = $_SESSION['id_pengguna'];
                // $id_memCourse = $_SESSION['idMemCourse'];
                $idCourse = $_GET['course'];

                //ambil nama course
                $query = "SELECT nama_course 
                          FROM courses
                          WHERE id_courses = $idCourse";
                $namaCourse = $this->db->executeSelectQuery($query);
                $namaCourse = $namaCourse[0]['nama_course'];

                //ambil soal" ujian di course bersangkutan
                $query = "SELECT *
                          FROM soal_ujian 
                          WHERE id_courses = $idCourse
                          ORDER BY nomor_soal ASC
                         ";
                $resultQuery = $this->db->executeSelectQuery($query);
                $result = [];
                foreach($resultQuery as $key => $value){
                    $result[] = new SoalUjian($value['id_soal_ujian'], $value['nomor_soal'], $value['soal'], $value['opsi1'], $value['opsi2'], $value['opsi3'], $value['kunci_jawaban'], $value['id_courses']);
                }

                return View::createViewTeacherExam('teacherExam.php', [
                    "result" => $result
                ], $namaCourse, $idCourse);

            }else{
                session_destroy();
                return View::createView('indexTeacher.php', []);
            }
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
                return $result;
                // return View::createViewTeacherProfile('teacherProfile.php', [
                //     "result"=>$result
                // ]);

            //belum login
            }else{
                session_destroy();
                header('Location: teacherLogin');
            }
        }
    }
?>