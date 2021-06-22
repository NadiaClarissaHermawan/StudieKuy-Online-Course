<?php 
    require_once "control/services/viewVerificationAdmin.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/sertificateRequest.php";
    require_once "model/TopUpRequest.php";

    class verificationAdminController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        //tampilan menu mau verifikasi yang mana 
        public function view_verifpageAdmin(){
            return View::createView('verificationAdmin.php', []);
        }

//VERIFIKASI SERTIFIKAT___________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________-
  
        //ambil request sertifikat 
        public function getSertificateRequest(){
            //cari yang belom diverifikasi & nilai akhir tidak null
            //status verif 0 = not verified, 1 = accepted, 2 = rejected
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
                       ORDER BY mc.id_memCourse DESC
                     ";
            
            $resQuery = $this->db->executeSelectQuery($query);

            $result = [];
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

        //show smua log sertif
        public function view_verifSertif(){
            $result = $this->getSertificateRequest();
            return View::createViewVerification('verificationSertif.php', [
                "result" => $result
            ]);
        }

        public function verifStatusFilter(){
            $status = $_GET['status'];
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
                        WHERE mc.nilai_akhir IS NOT NULL 
                        ";
            
            //all
            if($status == -1){
                $query .= " ORDER BY mc.id_memCourse DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new SertificateRequest($value['real_name'], $value['nilai_akhir'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang'], $value['status_verifikasi'], $value['id_memCourse']);
                }
                
                return View::createViewAjaxVerif('verificationAjaxSertif.php', [
                    "result" => $result
                ]);

            //belum diverifikasi
            }else if($status == 0){
                $query .= " AND mc.status_verifikasi = 0
                           ORDER BY mc.id_memCourse DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new SertificateRequest($value['real_name'], $value['nilai_akhir'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang'], $value['status_verifikasi'], $value['id_memCourse']);
                }

                return View::createViewAjaxVerif('verificationAjaxSertif.php', [
                    "result" => $result
                ]);
            
            //accepted
            }else if($status == 1){
                $query .= " AND mc.status_verifikasi = 1
                            ORDER BY mc.id_memCourse DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new SertificateRequest($value['real_name'], $value['nilai_akhir'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang'], $value['status_verifikasi'], $value['id_memCourse']);
                }
                
                return View::createViewAjaxVerif('verificationAjaxSertif.php', [
                    "result" => $result
                ]);

            //rejected
            }else if($status == 2){
                $query .= " AND mc.status_verifikasi = 2
                            ORDER BY mc.id_memCourse DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new SertificateRequest($value['real_name'], $value['nilai_akhir'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang'], $value['status_verifikasi'], $value['id_memCourse']);
                }
                
                return View::createViewAjaxVerif('verificationAjaxSertif.php', [
                    "result" => $result
                ]);
            }
        }

//VERIFIKASI TOP UP___________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________-
         
        //ambil keterangan top up
        public function getTopUpRequest(){
            //cari yang belom diverifikasi & nilai akhir tidak null
            //status verif 0 = rejected
            $query = "SELECT ts.id_transaksi_saldo, ts.tanggal_transaksi_saldo, p.real_name, ts.nominal_pengisian, ts.saldo_awal, ts.saldo_akhir, ts.bukti_trf, ts.status_verifikasi, ts.id_member
                      FROM transaksi_saldo ts INNER JOIN member m
                      ON ts.id_member = m.id_member INNER JOIN pengguna p
                      ON m.id_pengguna = p.id_pengguna
                      ORDER BY ts.id_transaksi_saldo DESC
                     ";
            $resQuery = $this->db->executeSelectQuery($query);

            $result = [];
            foreach($resQuery as $key => $value){
                $result[] = new TopUpRequest($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['real_name'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['bukti_trf'], $value['status_verifikasi'], $value['id_member']);
            }
            return $result;
        }

        //kalau topup udah di acc
        public function acceptTopUp(){
            
            $verif = $_GET['verif'];
            $idMember = $_GET['id'];
            $idTrans = $_GET['idTrans'];
            $topup = $_GET['topup']*1000/1000;

            $query = "SELECT saldo
                      FROM member
                      WHERE id_member = '$idMember' 
                     ";
            $saldoNow = $this->db->executeSelectQuery($query);
            $saldoNow = $saldoNow[0]['saldo']*1000/1000;

            $saldoNow = $saldoNow + $topup;

            if(isset($verif) && $verif!= ""){
                $query = "UPDATE transaksi_saldo
                          SET status_verifikasi = 1
                          WHERE  id_member = '$idMember' AND id_transaksi_saldo = '$idTrans'
                         ";
                $this->db->executeNonSelectQuery($query);

                $query = "UPDATE member
                          SET saldo = '$saldoNow'
                          WHERE id_member = '$idMember'
                         ";
                $this->db->executeNonSelectQuery($query);
            }
        }

        //kalau topup di reject
        public function rejectTopUp(){
            $verif = $_GET['verif2'];
            $idMember = $_GET['id'];
            $idTrans = $_GET['idTrans'];

            if(isset($verif) && $verif!= ""){
                $query = "UPDATE transaksi_saldo
                          SET status_verifikasi = 2
                          WHERE  id_member = '$idMember' AND id_transaksi_saldo = '$idTrans'
                         ";
                $this->db->executeNonSelectQuery($query);
            }
        }        

        public function view_verifTopUp(){
            $result = $this->getTopUpRequest();
            return View::createViewVerification('verificationTopUp.php', [
                "result" => $result
            ]);
        }

        public function verifTopupFilter(){
            $status = $_GET['status'];
            $query = "SELECT ts.id_transaksi_saldo, ts.tanggal_transaksi_saldo, p.real_name, ts.nominal_pengisian, ts.saldo_awal, ts.saldo_akhir, ts.bukti_trf, ts.status_verifikasi, ts.id_member
                      FROM transaksi_saldo ts INNER JOIN member m
                      ON ts.id_member = m.id_member INNER JOIN pengguna p
                      ON m.id_pengguna = p.id_pengguna
                    ";
            
            //all
            if($status == -1){
                $query .= " ORDER BY ts.id_transaksi_saldo DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new TopUpRequest($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['real_name'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['bukti_trf'], $value['status_verifikasi'], $value['id_member']);
                }
                
                return View::createViewAjaxVerif('verificationAjaxTopup.php', [
                    "result" => $result
                ]);

            //belum diverifikasi
            }else if($status == 0){
                $query .= " WHERE ts.status_verifikasi = 0
                           ORDER BY ts.id_transaksi_saldo DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new TopUpRequest($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['real_name'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['bukti_trf'], $value['status_verifikasi'], $value['id_member']);
                }

                return View::createViewAjaxVerif('verificationAjaxTopup.php', [
                    "result" => $result
                ]);
            
            //accepted
            }else if($status == 1){
                $query .= " WHERE ts.status_verifikasi = 1
                            ORDER BY ts.id_transaksi_saldo DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new TopUpRequest($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['real_name'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['bukti_trf'], $value['status_verifikasi'], $value['id_member']);
                }
                
                return View::createViewAjaxVerif('verificationAjaxTopup.php', [
                    "result" => $result
                ]);

            //rejected
            }else if($status == 2){
                $query .= " WHERE ts.status_verifikasi = 2
                            ORDER BY ts.id_transaksi_saldo DESC";
                $resQuery = $this->db->executeSelectQuery($query);

                $result = [];
                foreach($resQuery as $key => $value){
                    $result[] = new TopUpRequest($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['real_name'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['bukti_trf'], $value['status_verifikasi'], $value['id_member']);
                }
                
                return View::createViewAjaxVerif('verificationAjaxTopup.php', [
                    "result" => $result
                ]);
            }
        }
    }
?>