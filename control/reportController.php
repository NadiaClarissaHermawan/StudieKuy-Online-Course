<?php 
    require_once "control/services/viewReport.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/CourseReport.php";
    require_once "model/TopUpReport.php";
    require_once "model/CourseTransactionReport.php";

    class reportController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        //ambil course report 
        public function getCourseReport($nama, $complete, $nilai){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $query = "SELECT p.real_name, mm.nilai_akhir, mm.status_ketuntasan, 
                             mm.status_verifikasi, mm.tanggal_tuntas,
                             c.nama_course, c.batas_nilai_minimum, bb.nama_bidang
                      FROM pengguna p INNER JOIN member m 
                            ON p.id_pengguna = m.id_pengguna
                            INNER JOIN member_course mm
                            ON mm.id_member = m.id_member
                            INNER JOIN courses c 
                            ON c.id_courses = mm.id_courses
                            INNER JOIN bidang_course b 
                            ON b.id_courses = c.id_courses
                            INNER JOIN bidang bb 
                            ON bb.id_bidang = b.id_bidang
                     ";

            $cekFilter = 0;
            //cek filter nama
            if($nama != ""){
                $query .= " WHERE p.real_name LIKE '%$nama%'";
                $cekFilter = 1;
            }

            //cek filter status ketuntasan
            if($complete != ""){
                if($cekFilter == 0){
                    $query .= " WHERE mm.status_ketuntasan = '$complete'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND mm.status_ketuntasan = '$complete'";
                }
            }

            //cek filter nilai akhir
            if($nilai != ""){
                if($cekFilter == 0){
                    $query .= " WHERE mm.nilai_akhir = '$nilai'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND mm.nilai_akhir = '$nilai'";
                }
            }

            $queryResult = $this->db->executeSelectQuery($query);

            $result = [];
            foreach($queryResult as $key => $value) {
                $result[] = new CourseReport($value['real_name'], $value['nilai_akhir'], $value['status_ketuntasan'], $value['status_verifikasi'], $value['tanggal_tuntas'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang']);
            }
            return $result;
        }   

        public function getCourseReport_filter(){
            $nama = $_GET['name']; 
            $complete = $_GET['complete'];
            $nilai = $_GET['nilai'];

            $result = $this->getCourseReport($nama, $complete, $nilai);
            return View::createViewFilter('ajaxCourseReport.php',[
                "result"=>$result
            ]);
        }

        //view course report
        public function view_courseReport(){
            $result = $this->getCourseReport("", "", "");
            return View::createView('reportCourse.php', [
                "result"=>$result
            ]);
        }

//TOP UP REPORT____________________________________________________________________________________________________________________________________________

        //ambil top-up report 
        public function getTopUpReport($id, $status, $tglAwal, $tglAkhir){
            $query = "SELECT id_transaksi_saldo, tanggal_transaksi_saldo, nominal_pengisian, saldo_awal, saldo_akhir, status_verifikasi
                      FROM transaksi_saldo
                     ";

            $cekFilter = 0;
            //cek filter id
            if($id != ""){
                $query .= " WHERE id_transaksi_saldo = '$id'";
                $cekFilter = 1;
            }

            //cek status verifikasi
            if($status != ""){
                if($cekFilter == 0){
                    if(strpos($status, "v") || strpos($status, "ve") || strpos($status, "ver") || strpos($status, "veri")|| strpos($status, "verif")|| strpos($status, "verifi")|| strpos($status, "verifie")|| strpos($status, "verified")){
                        $status = 1;
                    }else if(strpos($status, "r") || strpos($status, "re") || strpos($status, "rej") || strpos($status, "reje")|| strpos($status, "rejec")|| strpos($status, "reject")|| strpos($status, "rejecte")|| strpos($status, "rejected")){
                        $status = 2;
                    }else if(strpos($status, "n") || strpos($status, "no") || strpos($status, "not") || strpos($status, "not v")|| strpos($status, "not ve")|| strpos($status, "not ver")|| strpos($status, "not veri")|| strpos($status, "not verif") || strpos($status, "not verifi") || strpos($status, "not verifie")|| strpos($status, "not verified") || strpos($status, "not verified y") || strpos($status, "not verified ye") || strpos($status, "not verified yet")){
                        $status = 0;
                    }
                    $query .= " WHERE status_verifikasi = '$status'";
                    $cekFilter = 1;
                }else{  
                    if(strpos($status, "v") || strpos($status, "ve") || strpos($status, "ver") || strpos($status, "veri")|| strpos($status, "verif")|| strpos($status, "verifi")|| strpos($status, "verifie")|| strpos($status, "verified")){
                        $status = 1;
                    }else if(strpos($status, "r") || strpos($status, "re") || strpos($status, "rej") || strpos($status, "reje")|| strpos($status, "rejec")|| strpos($status, "reject")|| strpos($status, "rejecte")|| strpos($status, "rejected")){
                        $status = 2;
                    }else if(strpos($status, "n") || strpos($status, "no") || strpos($status, "not") || strpos($status, "not v")|| strpos($status, "not ve")|| strpos($status, "not ver")|| strpos($status, "not veri")|| strpos($status, "not verif") || strpos($status, "not verifi") || strpos($status, "not verifie")|| strpos($status, "not verified") || strpos($status, "not verified y") || strpos($status, "not verified ye") || strpos($status, "not verified yet")){
                        $status = 0;
                    }
                    
                    $query .= " AND status_verifikasi = '$status'";
                    $cekFilter = 1;
                }
            }

            //cek range tanggal
            if($tglAwal != ""){
                if($cekFilter == 0){
                    if($tglAkhir != ""){
                        $query .= " WHERE tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAkhir != ""){
                        $query .= " AND tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }
            }else if($tglAkhir != ""){
                if($cekFilter == 0){
                    if($tglAwal != ""){
                        $query .= " WHERE tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_saldo <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAwal != ""){
                        $query .= " AND tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_saldo <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }
            }

            $queryResult = $this->db->executeSelectQuery($query);

            $result = [];
            foreach($queryResult as $key => $value) {
                $result[] = new TopUpReport($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['status_verifikasi']);
            }
            return $result;
        }

        public function getTopupReport_filter(){
            $id = $_GET['id']; 
            $status = $_GET['status'];
            $tglAwal = $_GET['tglAwal'];
            $tglAkhir = $_GET['tglAkhir'];

            $result = $this->getTopupReport($id, $status, $tglAwal, $tglAkhir);
            return View::createViewFilter('ajaxTopupReport.php',[
                "result"=>$result
            ]);
        }

        public function view_topUpReport(){
            $result = $this->getTopUpReport("", "", "", "");
            return View::createView('reportTopUp.php', [
                "result"=>$result
            ]);
        }

//COURSE TRANSACTION REPORT____________________________________________________________________________________________________________________________________________
                
        public function getCourseTransactionReport($course, $status, $id, $rate, $tglAwal, $tglAkhir){
            $query = "SELECT tc.id_transaksi_course, tc.tanggal_transaksi_course,
                            c.tarif, tc.saldo_awal, tc.saldo_akhir,
                            c.nama_course, mm.status_verifikasi
                    FROM pengguna p INNER JOIN member m 
                            ON p.id_pengguna = m.id_pengguna
                            INNER JOIN member_course mm
                            ON mm.id_member = m.id_member
                            INNER JOIN transaksi_course tc
                            ON tc.id_member = m.id_member
                            INNER JOIN courses c 
                            ON c.id_courses = tc.id_courses
                    ";


            $cekFilter = 0;
            //cek filter course
            if($course != ""){
                $query .= " WHERE c.nama_course LIKE '%$course%'";
                $cekFilter = 1;
            }

            //cek filter status verifikasi
            if($status != ""){
                if($cekFilter == 0){
                    if(strpos($status, "v") || strpos($status, "ve") || strpos($status, "ver") || strpos($status, "veri")|| strpos($status, "verif")|| strpos($status, "verifi")|| strpos($status, "verifie")|| strpos($status, "verified")){
                        $status = 1;
                    }else if(strpos($status, "r") || strpos($status, "re") || strpos($status, "rej") || strpos($status, "reje")|| strpos($status, "rejec")|| strpos($status, "reject")|| strpos($status, "rejecte")|| strpos($status, "rejected")){
                        $status = 2;
                    }else if(strpos($status, "n") || strpos($status, "no") || strpos($status, "not") || strpos($status, "not v")|| strpos($status, "not ve")|| strpos($status, "not ver")|| strpos($status, "not veri")|| strpos($status, "not verif") || strpos($status, "not verifi") || strpos($status, "not verifie")|| strpos($status, "not verified") || strpos($status, "not verified y") || strpos($status, "not verified ye") || strpos($status, "not verified yet")){
                        $status = 0;
                    }
                    $query .= " WHERE status_verifikasi = '$status'";
                    $cekFilter = 1;
                }else{  
                    if(strpos($status, "v") || strpos($status, "ve") || strpos($status, "ver") || strpos($status, "veri")|| strpos($status, "verif")|| strpos($status, "verifi")|| strpos($status, "verifie")|| strpos($status, "verified")){
                        $status = 1;
                    }else if(strpos($status, "r") || strpos($status, "re") || strpos($status, "rej") || strpos($status, "reje")|| strpos($status, "rejec")|| strpos($status, "reject")|| strpos($status, "rejecte")|| strpos($status, "rejected")){
                        $status = 2;
                    }else if(strpos($status, "n") || strpos($status, "no") || strpos($status, "not") || strpos($status, "not v")|| strpos($status, "not ve")|| strpos($status, "not ver")|| strpos($status, "not veri")|| strpos($status, "not verif") || strpos($status, "not verifi") || strpos($status, "not verifie")|| strpos($status, "not verified") || strpos($status, "not verified y") || strpos($status, "not verified ye") || strpos($status, "not verified yet")){
                        $status = 0;
                    }
                    
                    $query .= " AND status_verifikasi = '$status'";
                    $cekFilter = 1;
                }
            }

            //cek filter id
            if($id != ""){
                if($cekFilter == 0){
                    $query .= " WHERE tc.id_transaksi_course = '$id'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND tc.id_transaksi_course = '$id'";
                }
            }

            //cek filter harga
            if($rate != ""){
                if($cekFilter == 0){
                    $query .= " WHERE c.tarif = '$rate'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND c.tarif = '$rate'";
                }
            }

            //cek filter range tgl 
            if($tglAwal != ""){
                if($cekFilter == 0){
                    if($tglAkhir != ""){
                        $query .= " WHERE tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAkhir != ""){
                        $query .= " AND tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }
            }else if($tglAkhir != ""){
                if($cekFilter == 0){
                    if($tglAwal != ""){
                        $query .= " WHERE tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_saldo <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAwal != ""){
                        $query .= " AND tanggal_transaksi_saldo <= '$tglAkhir' AND tanggal_transaksi_saldo >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_saldo <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }
            }


            $queryResult = $this->db->executeSelectQuery($query);
            foreach($queryResult as $key => $value) {
                $result[] = new TransactionCourseReport($value['id_transaksi_course'], $value['tanggal_transaksi_course'], $value['tarif'], $value['saldo_awal'], $value['saldo_akhir'], $value['nama_course'], $value['status_verifikasi']);
            }
            return $result;
        }

        public function getTransactionReport_filter(){
            $course = $_GET['course'];
            $status = $_GET['status'];
            $id = $_GET['id'];
            $rate = $_GET['rate'];
            $tglAwal= $_GET['tglAwal'];
            $tglAkhir= $_GET['tglAkhir'];

            $result = $this->getCourseTransactionReport($course, $status, $id, $rate, $tglAwal, $tglAkhir);
            return View::createViewFilter('ajaxCourseTransactionReport.php',[
                "result"=>$result
            ]);
        }

        public function view_courseTransactionReport(){
            $result = $this->getCourseTransactionReport("", "", "", "", "", "");
            return View::createView('reportCourseTransaction.php', [
                "result"=>$result
            ]);
        }
    }
?>