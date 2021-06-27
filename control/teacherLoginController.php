<?php 
    session_start();
    require_once "control/services/viewTeacherLoginRegister.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/teacher.php";

    class teacherLoginController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_teacherLoginpage(){
            return View::createView('teacherLogin.php', []);
        }

        public function klik_login(){
            $uname = $_POST['uname'];
            $upass = $_POST['upass'];
            if(isset($uname) && $uname!="" && isset($upass) && $uname!=""){
                $uname = $this->db->escapeString($uname);
                $upass = $this->db->escapeString($upass);
                
                $query = "SELECT p.pass, p.status
                          FROM pengajar m INNER JOIN pengguna p
                          ON m.id_pengguna = p.id_pengguna
                          WHERE m.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE nama_user = '$uname')
                         ";
                $resQuery = $this->db->executeSelectQuery($query);
                $pass_asli = $resQuery[0]['pass'];
                $stat = $resQuery[0]['status'];
               
                //username not found
                if(empty($pass_asli)){
                    $_SESSION['unameNotFound'] = 0;
                    header('Location: teacherLogin');

                }else if($stat == 0) {
                    $_SESSION['unameNotFound'] = 0;
                    header('Location: teacherLogin');                  
                }else{
                   //password benar
                   if($upass == $pass_asli){
                    $query = "SELECT p.id_pengguna 
                              FROM pengguna p
                              WHERE nama_user = '$uname' AND pass = '$upass'
                            ";
                    $resQuery = $this->db->executeSelectQuery($query);
                    
                    $_SESSION['id_pengguna'] = $resQuery[0]['id_pengguna'];
                    $_SESSION['statusTeacher'] = 1;
                    header('Location: indexTeacher');

                    //password salah
                    }else{
                        $_SESSION['unameNotFound'] = $uname;
                        var_dump("salah");
                        die;
                        header('Location: teacherLogin');
                        die;
                    }
                }
            }
        }

        //logout teacher
        public function logout(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            session_destroy();
            header('Location: teacherLogin');
            die;
        }

        //ambil data profile teacher
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

            //belum login
            }else{
                session_destroy();
                header('Location: teacherLogin');
            }
        }

        //liat profile edit 
        public function viewEditTeacherProfile(){
            $result = $this->getTeacherProfile();
            return View::createViewTeacherProfile('teacherEditProfile.php', [
                "result"=>$result
            ]);
        }

         //edit profile text info
         public function teacherProfileTextEdit(){
            $id_p = $_SESSION['id_pengguna'];
            $urealname = $_POST['urealname'];
            $uname = $_POST['uname'];
            $upass = $_POST['upass'];
            $uemail = $_POST['uemail'];

            $urealname = $this->db->escapeString($urealname);
            $uname = $this->db->escapeString($uname);
            $upass = $this->db->escapeString($upass);
            $uemail = $this->db->escapeString($uemail);

            //update info yg ada di tabel pengguna
            $query = "UPDATE pengguna 
                      SET nama_user = '$uname', real_name = '$urealname', pass = '$upass', email = '$uemail'
                      WHERE id_pengguna = '$id_p'
                     ";
            $this->db->executeNonSelectQuery($query);
            header('Location: teacherProfile');
            die;
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
                              SET profile_picture = '$tempProf'
                              WHERE id_pengguna = $tempUser
                             ";
                    $this->db->executeNonSelectQuery($query);
                }else{
                    return '{"result":"error"}';
                }   
            }
        }

        //edit profile text info
        public function view_teacherEditProfile(){
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

            //update info di tabel teacher
            $query = "UPDATE pengajar
                      SET kontak = '$uphone', alamat = '$uaddress'
                      WHERE id_pengguna = '$id_p'
                     ";
            $this->db->executeNonSelectQuery($query);
        }
    }
?>