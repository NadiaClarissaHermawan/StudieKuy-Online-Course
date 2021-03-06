<?php 
    require_once "control/services/viewIndex.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/saldo.php";
    require_once "model/listMemberCourse.php";
    require_once "model/modul.php";
    require_once "model/soalUjian.php";
    require_once "model/bidangCourse.php";
    require_once "model/course.php";
    require_once "model/progress.php";
    require_once "model/sertifikat.php";

    class indexController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_mainpage(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $result[] = new Saldo($value['saldo']);
                }
                return View::createView('index.php', [
                    "result" => $result
                ]);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('index.php', []);
            }
        }

        //lihat list course yang sudah di enroll member
        public function view_coursesList(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $start = 0;
            if(isset($_GET['start']) && $_GET['start'] != ""){
                //page
                $start = $_GET['start'];
                //index start
                $indexStart = (($start-1)*3);
            }else{
                $indexStart = 0;
            }

            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $saldo[] = new Saldo($value['saldo']);
                }

                //query matkul yg uda diambil user
                $query = "SELECT mc.id_memCourse, mc.id_courses, c.nama_course
                          FROM member_course mc INNER JOIN courses c
                          ON mc.id_courses = c.id_courses
                          WHERE mc.id_member = (SELECT m.id_member 
                                                FROM member m INNER JOIN pengguna p
                                                ON m.id_pengguna = p.id_pengguna
                                                WHERE p.id_pengguna = '$id'
                                                )
                         ";
                $query .= " LIMIT 3 OFFSET $indexStart";
                $queryResult = $this->db->executeSelectQuery($query);
                $result = [];
                foreach($queryResult as $key =>$value){
                    $result[] = new ListMemberCourse($value['id_memCourse'], $value['id_courses'], $value['nama_course']);
                }

                //hitung jmlh page max
                $resultSize = count($result);
                $query = "SELECT COUNT(id_memCourse) AS 'jmlh'
                          FROM member_course
                          WHERE id_member = (SELECT m.id_member 
                                                FROM member m INNER JOIN pengguna p
                                                ON m.id_pengguna = p.id_pengguna
                                                WHERE p.id_pengguna = '$id'
                                            )
                         ";
                $ress = $this->db->executeSelectQuery($query)[0]['jmlh'];
                $jumlahPage = ($ress/3)+1;

                return View::createViewList('list.php', [
                    "result" => $result,
                    "jmlhPage"=>$jumlahPage,
                    "indexStart"=>$indexStart
                ], $saldo, $start);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('userLogin.php', []);
            }
        }

        public function view_coursesDetail(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $result[] = new Saldo($value['saldo']);
                }

                $id_memCourse = $_GET['idMemCourse'];
                //cari nama course
                $query = "SELECT nama_course 
                          FROM courses
                          WHERE id_courses = (SELECT id_courses FROM member_course WHERE id_memCourse = '$id_memCourse')
                         ";
                $namaCourse = $this->db->executeSelectQuery($query);
                $namaCourse = $namaCourse[0]['nama_course'];

                return View::createViewCourseDetail('coursesDetail.php', [
                    "result" => $result
                ], $namaCourse);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('index.php', []);
            }
        }

        //view courses dalam 1 bidang
        public function view_bidangCourse(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            
            //sudah login - > ambil saldo user
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                $saldoUser = $saldoUser[0]['saldo'];

            //belum login
            }else{
                session_destroy();
                $saldoUser = "";
            }
            
            $namaBidang = $_GET['bidang'];
            //cari course" dalam bidang yg dipilih
            $query = "SELECT c.id_courses, c.nama_course, c.gambar_courses
                      FROM courses c INNER JOIN bidang_course bc
                      ON c.id_courses = bc.id_courses
                      INNER JOIN bidang b
                      ON b.id_bidang = bc.id_bidang
                      WHERE b.nama_bidang = '$namaBidang'
                     ";
            $courses = $this->db->executeSelectQuery($query);
            $result = [];
            foreach($courses as $key => $value){
                $result[] = new BidangCourse($value['id_courses'], $value['nama_course'], $value['gambar_courses']);
            }
            return View::createViewBidangCourse('bidangCourse.php', [
                "result" => $result
            ], $saldoUser, $namaBidang);
        }

        //lihat detail dari salah 1 course
        public function view_courseInfo(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            
            //sudah login - > ambil saldo user
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                $saldoUser = $saldoUser[0]['saldo'];

            //belum login
            }else{
                session_destroy();
                $saldoUser = "";
            }

            $namaCourse = $_GET['course'];
            $namaBidang = $_GET['bidang'];
            //cari full info course tsb
            $query = "SELECT *
                     FROM courses
                     WHERE nama_course  = '$namaCourse'
                     ";
            $resQuery = $this->db->executeSelectQuery($query);
            foreach($resQuery as $key => $value){
                $result[] = new Course($value['id_courses'], $value['tarif'], $value['batas_nilai_minimum'], $value['keterangan_course'], $value['gambar_courses']);
            }

            //cari nama" modul dari course tsb
            $query = "SELECT nama_modul
                      FROM modul
                      WHERE id_courses = (SELECT id_courses FROM courses WHERE nama_course = '$namaCourse')
                     ";
            $resQuery = $this->db->executeSelectQuery($query);

            return View::createViewCourseInfo('courseInfo.php', [
                "result"=>$result
            ], $resQuery, $saldoUser, $namaBidang, $namaCourse);
        }

        //melihat modul" dr course yg sdh di enroll
        public function view_courseModul(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $id_memCourse = $_SESSION['idMemCourse'];

                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $res1[] = new Saldo($value['saldo']);
                }
                $saldo = $res1[0]->getSaldo();

                //ambil direktori modul" dari course bersangkutan
                $query = "SELECT isi_modul, nama_modul, nama_course, c.id_courses
                            FROM modul INNER JOIN courses c
                                    ON modul.id_courses = c.id_courses
                            WHERE modul.id_courses = (SELECT id_courses
                                                    FROM member_course
                                                    WHERE id_memCourse = '$id_memCourse'
                                                    )
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
                
                return View::createViewCourseModul('courseModul.php', [
                    "result" => $result
                ], $saldo, $sumberModul, $selectedModulName);
            
            //belum login
            }else{
                session_destroy();
                return View::createView('index.php', []);
            }
        }

        public function view_courseExam(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $id_memCourse = $_SESSION['idMemCourse'];

                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $res1[] = new Saldo($value['saldo']);
                }
                $saldo = $res1[0]->getSaldo();

                //ambil nama course
                $query = "SELECT nama_course 
                          FROM courses
                          WHERE id_courses = (SELECT id_courses 
                                              FROM member_course
                                              WHERE id_memCourse = '$id_memCourse'
                                             )
                         ";
                $namaCourse = $this->db->executeSelectQuery($query);
                $namaCourse = $namaCourse[0]['nama_course'];

                //ambil soal" ujian di course bersangkutan
                $query = "SELECT *
                          FROM soal_ujian 
                          WHERE id_courses = ( SELECT id_courses
                                               FROM member_course
                                               WHERE id_memCourse = '$id_memCourse'
                                             )
                          ORDER BY nomor_soal ASC
                         ";
                $resultQuery = $this->db->executeSelectQuery($query);
                $result = [];
                foreach($resultQuery as $key => $value){
                    $result[] = new SoalUjian($value['id_soal_ujian'], $value['nomor_soal'], $value['soal'], $value['opsi1'], $value['opsi2'], $value['opsi3'], $value['kunci_jawaban'], $value['id_courses']);
                }

                return View::createViewCourseExam('courseExam.php', [
                    "result" => $result
                ], $saldo, $namaCourse, $id_memCourse);

            }else{
                session_destroy();
                return View::createView('index.php', []);
            }
        }

        //periksa jawaban
        public function cekJawaban(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $id_course = $_POST['idCourse'];
            $id_memCourse = $_SESSION['idMemCourse'];

            //ambil kunjaw
            $query = "SELECT *
                      FROM soal_ujian
                      WHERE id_courses = (SELECT id_courses
                                          FROM member_course
                                          WHERE id_memCourse = '$id_memCourse'
                                         )
                      ORDER BY nomor_soal ASC
                     ";
            $resQuery = $this->db->executeSelectQuery($query);
            $benar = 0;
            //cek jawaban benar
            foreach($resQuery as $key => $value){
                if(isset($_POST['opt'.$key]) && $_POST['opt'.$key] == $value['kunci_jawaban']){
                    $benar ++;
                }
            }
            $panjangResQuery = count($resQuery);
            //nilai akhir
            $benar = $benar / $panjangResQuery * 100;

            //ambil batas nilai minimum course
            $query = "SELECT batas_nilai_minimum
                      FROM courses
                      WHERE id_courses = '$id_course'
                     ";
            $batas = $this->db->executeSelectQuery($query);
            $batas = $batas[0]['batas_nilai_minimum'];

            //update nilai akhir & status ketuntasan
            //lulus
            if($benar >= $batas){
                $query = "UPDATE member_course
                SET nilai_akhir = '$benar', tanggal_tuntas = now(), status_ketuntasan = '1'
                WHERE id_memCourse = '$id_memCourse'
               ";
            //tidak lulus
            }else{
                $query = "UPDATE member_course
                      SET nilai_akhir = '$benar', tanggal_tuntas = now(), status_ketuntasan = '2'
                      WHERE id_memCourse = '$id_memCourse'
                     ";
            }
            $this->db->executeNonSelectQuery($query);

            //timeout
            if($_POST['timeOutStatus'] == 1){
                header('Location: timeOut?idMemCourse='.$id_memCourse);
            }else{
                header('Location: examFinished?idMemCourse='.$id_memCourse);
            }
        }

        //beli course 
        public function view_buyCourse(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            //sudah login
            if(isset($_SESSION['status']) && $_SESSION['status']!= ""){
                $id_pengguna = $_SESSION['id_pengguna'];
                //ambil saldo user skrg & id membernya
                $query = "SELECT saldo, id_member
                          FROM member
                          WHERE id_pengguna = '$id_pengguna'
                         ";
                $resQuery = $this->db->executeSelectQuery($query);
                $saldo = $resQuery[0]['saldo'];
                $idMember = $resQuery[0]['id_member'];
               
                //ambil harga course & id course
                $tarif = $_GET['tarif'];
                $id_course = $_GET['idCourse'];
    
                //get nama course
                $query = "SELECT nama_course
                          FROM courses
                          WHERE id_courses = '$id_course'
                         ";
                $namaCourse = $this->db->executeSelectQuery($query)[0]['nama_course']; 
    
                //saldo cukup
                if($saldo >= $tarif){
                    $query = "INSERT INTO transaksi_course (saldo_awal, saldo_akhir, tanggal_transaksi_course, id_courses, id_member)
                              VALUES ($saldo, ($saldo - $tarif), now(), $id_course, $idMember)
                             ";
                    $this->db->executeNonSelectQuery($query);
    
                    //update saldo now user
                    $query = "UPDATE member
                             SET saldo = ($saldo-$tarif)
                             WHERE id_member = '$idMember'
                             ";
                    $this->db->executeNonSelectQuery($query);

                    //masukin course ke dlm member_course
                    $query = "INSERT INTO member_course (status_ketuntasan, status_verifikasi, id_member, id_courses)
                              VALUES (0, 0, $idMember, $id_course)
                             ";
                    $this->db->executeNonSelectQuery($query);
    
                    return View::createViewBuyCourse('buyCourse.php', [], 1, $namaCourse, $saldo-$tarif);
    
                //saldo tdk cukup
                }else{
                    return View::createViewBuyCourse('buyCourse.php', [], 0, $namaCourse, $saldo);
                }
            //blm login
            }else{
                header('Location: userLogin');
            }
            
        }

        public function view_examFinished(){
            $id_memCourse = $_GET['idMemCourse'];
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $saldo = 0;
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $id_memCourse = $_SESSION['idMemCourse'];

                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $res1[] = new Saldo($value['saldo']);
                }
                $saldo = $res1[0]->getSaldo();
            }
            return View::createViewExamFinished('examFinished.php', [], $id_memCourse, $saldo);
        }

        public function view_timeOut(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $saldo = 0;
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $id_memCourse = $_SESSION['idMemCourse'];

                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $res1[] = new Saldo($value['saldo']);
                }
                $saldo = $res1[0]->getSaldo();
            }
            return View::createViewTimeOut('timeOut.php', [], $saldo);
        }

        public function view_progress(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            
            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $id_memCourse = $_SESSION['idMemCourse'];

                //ambil saldo member
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $res1[] = new Saldo($value['saldo']);
                }
                $saldo = $res1[0]->getSaldo();

                //ambil nilai akhir 
                $query = "SELECT mc.id_memCourse, mc.nilai_akhir, mc.status_ketuntasan, mc.tanggal_tuntas, c.batas_nilai_minimum, mc.status_verifikasi
                          FROM member_course mc INNER JOIN courses c
                          ON mc.id_courses = c.id_courses
                          WHERE id_memCourse = '$id_memCourse'
                         ";
                $resQuery = $this->db->executeSelectQuery($query);
                $result= [];
                foreach($resQuery as $key => $value){
                    $result[] = new Progress($value['id_memCourse'], $value['nilai_akhir'], $value['status_ketuntasan'], $value['tanggal_tuntas'], $value['status_verifikasi']);
                }

                return View::createViewProgress('progress.php', [
                    "result" => $result
                ], $saldo);
            
            }else{
                session_destroy();
                header('Location: index');
            }
        }


        //view sertifikat page kalau sdh di verifikasi

        public function view_sertif(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $id = $_SESSION['id_pengguna'];
            $id_memCourse = $_SESSION['idMemCourse'];

            //ambil saldo member
            $query = "SELECT saldo 
                    FROM member 
                    WHERE id_pengguna = '$id'
                    ";
            $saldoUser = $this->db->executeSelectQuery($query);
            foreach($saldoUser as $key =>$value){
                $res1[] = new Saldo($value['saldo']);
            }
            $saldo = $res1[0]->getSaldo();

            //ambil keterangan sertifikat
            $query = "SELECT p.real_name, mc.tanggal_tuntas, s.nama_sertif
                      FROM pengguna p INNER JOIN member m ON p.id_pengguna = m.id_pengguna
                      INNER JOIN member_course mc ON mc.id_member=m.id_member
                      INNER JOIN sertifikat s ON s.id_courses = mc.id_courses
                      WHERE p.id_pengguna = '$id' AND mc.id_memCourse = '$id_memCourse'
                     ";
            $resQuery = $this->db->executeSelectQuery($query);
            foreach($resQuery as $key => $value){
                $result[] = new Sertifikat($value['real_name'], $value['tanggal_tuntas'], $value['nama_sertif']);
            }
            return View::createViewSertif('sertifikat.php', [
                "result"=>$result
            ], $saldo);
        }
    }
?>