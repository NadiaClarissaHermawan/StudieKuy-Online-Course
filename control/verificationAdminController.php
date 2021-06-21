<?php 
    require_once "control/services/viewVerificationAdmin.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/sertificateRequest.php";

    class verificationAdminController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        //tampilan menu 
        public function view_verifpageAdmin(){
            return View::createView('verificationAdmin.php', []);
        }

        //ambil keterangan sertifikat
        public function getSertificateRequest(){
            //cari yang belom diverifikasi & nilai akhir tidak null
            //status verif 0 = rejected
            $query = "SELECT p.real_name, mc.nilai_akhir, c.nama_course, 
                             c.batas_nilai_minimum, b.nama_bidang, mc.status_verifikasi, mc.id_memCourse
                      FROM member m INNER JOIN pengguna p
                            ON m.id_pengguna = p.id_pengguna
                            INNER JOIN member_course mc 
                            ON mc.id_member = m.id_member
                            INNER JOIN courses c 
                            ON c.id_courses = mc.id_courses
                            INNER JOIN bidang_course bc
                            ON bc.id_courses = c.id_courses
                            INNER JOIN bidang b
                            ON bc.id_bidang = b.id_bidang
                       WHERE mc.nilai_akhir IS NOT NULL AND mc.status_ketuntasan IS NOT NULL
                     ";
            $resQuery = $this->db->executeSelectQuery($query);

            foreach($resQuery as $key => $value){
                $result[] = new SertificateRequest($value['real_name'], $value['nilai_akhir'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang'], $value['status_verifikasi'], $value['id_memCourse']);
            }
            return $result;
        }

        //kalau sertif udah di acc
        public function acceptSertif(){
            
            $verif = $_GET['verif'];
            $idMemCourse = $_GET['id'];

            if(isset($verif) && $verif!= ""){
                $query = "UPDATE member_course
                          SET status_verifikasi = 1
                          WHERE  id_memCourse = '$idMemCourse'
                         ";
                $this->db->executeNonSelectQuery($query);
            }
        }

        //kalau sertif di reject
        public function rejectSertif(){
            $verif = $_GET['verif2'];
            $idMemCourse = $_GET['id'];

            if(isset($verif) && $verif!= ""){
                $query = "UPDATE member_course
                          SET status_verifikasi = 2
                          WHERE  id_memCourse = '$idMemCourse'
                         ";
                $this->db->executeNonSelectQuery($query);
            }
        }

        public function view_verifSertif(){
            $result = $this->getSertificateRequest();
            return View::createViewVerification('verificationSertif.php', [
                "result" => $result
            ]);
        }
        
        public function view_verifTopUp(){
            return View::createViewVerification('verificationTopUp.php', []);
        }
    }
?>