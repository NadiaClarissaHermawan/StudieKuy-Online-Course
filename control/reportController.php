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
        public function getCourseReport($nama, $complete, $nilai, $start){
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
                    $query .= " WHERE mm.nilai_akhir LIKE '%$nilai%'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND mm.nilai_akhir = '%$nilai%'";
                }
            }

            $query .= " LIMIT 5 OFFSET $start";
            $queryResult = $this->db->executeSelectQuery($query);

            $result = [];
            foreach($queryResult as $key => $value) {
                $result[] = new CourseReport($value['real_name'], $value['nilai_akhir'], $value['status_ketuntasan'], $value['status_verifikasi'], $value['tanggal_tuntas'], $value['nama_course'], $value['batas_nilai_minimum'], $value['nama_bidang']);
            }
            return $result;
        }   

        public function getCourseReport2($nama, $complete, $nilai){
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
                    $query .= " WHERE mm.nilai_akhir LIKE '%$nilai%'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND mm.nilai_akhir = '%$nilai%'";
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

            $result = $this->getCourseReport2($nama, $complete, $nilai, 0);

            return View::createViewFilter('ajaxCourseReport.php',[
                "result"=>$result
            ]);
        }

        //view course report
        public function view_courseReport(){
            $start = 0;

            //di page ke 'start'
            if(isset($_GET['start']) && $start != ""){
                //5 = jumlah data di 1 page
                $start = $_GET['start'];
                $indexStart = (($start-1)*5)+1;
                $result = $this->getCourseReport("","","",$indexStart);
            
            //awal
            }else{
                $indexStart = 0;
                $result = $this->getCourseReport("", "", "", $start);
            }

            $resultSize = count($result);
            $query = "SELECT COUNT(id_memCourse) AS 'jmlh'
                      FROM member_course
                     ";
            $ress = $this->db->executeSelectQuery($query)[0]['jmlh'];
            $jumlahPage = ($ress/5)+1;

            return View::createView('reportCourse.php', [
                "result"=>$result,
                "jmlhPage"=>$jumlahPage,
                "indexStart"=>$indexStart
            ]);
        }

//TOP UP REPORT____________________________________________________________________________________________________________________________________________

        //ambil top-up report 
        public function getTopUpReport($id, $status, $tglAwal, $tglAkhir, $start){
            $query = "SELECT id_transaksi_saldo, tanggal_transaksi_saldo, nominal_pengisian, saldo_awal, saldo_akhir, status_verifikasi
                      FROM transaksi_saldo
                     ";

            $cekFilter = 0;
            //cek filter id
            if($id != ""){
                $query .= " WHERE id_transaksi_saldo LIKE '%$id%'";
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
            $query .= " LIMIT 5 OFFSET $start";
            $queryResult = $this->db->executeSelectQuery($query);

            $result = [];
            foreach($queryResult as $key => $value) {
                $result[] = new TopUpReport($value['id_transaksi_saldo'], $value['tanggal_transaksi_saldo'], $value['nominal_pengisian'], $value['saldo_awal'], $value['saldo_akhir'], $value['status_verifikasi']);
            }
            return $result;
        }

        public function getTopUpReport2($id, $status, $tglAwal, $tglAkhir){
            $query = "SELECT id_transaksi_saldo, tanggal_transaksi_saldo, nominal_pengisian, saldo_awal, saldo_akhir, status_verifikasi
                      FROM transaksi_saldo
                     ";

            $cekFilter = 0;
            //cek filter id
            if($id != ""){
                $query .= " WHERE id_transaksi_saldo LIKE '%$id%'";
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

            $result = $this->getTopupReport2($id, $status, $tglAwal, $tglAkhir,0);
            return View::createViewFilter('ajaxTopupReport.php',[
                "result"=>$result
            ]);
        }

        public function view_topUpReport(){
            $start = 0;

            //di page ke 'start'
            if(isset($_GET['start']) && $start != ""){
                //5 = jumlah data di 1 page
                $start = $_GET['start'];
                $indexStart = (($start-1)*5)+1;
                $result = $this->getTopupReport("","","","",$indexStart);
            
            //awal
            }else{
                $indexStart = 0;
                $result = $this->getTopupReport("", "", "","", $start);
            }

            $resultSize = count($result);
            $query = "SELECT COUNT(id_transaksi_saldo) AS 'jmlh'
                      FROM transaksi_saldo
                     ";
            $ress = $this->db->executeSelectQuery($query)[0]['jmlh'];
            // var_dump($ress);
            // die;
            $jumlahPage = ($ress/5)+1;
            
            return View::createView('reportTopUp.php', [
                "result"=>$result,
                "jmlhPage"=>$jumlahPage,
                "indexStart"=>$indexStart
            ]);
        }

//COURSE TRANSACTION REPORT____________________________________________________________________________________________________________________________________________
                
        public function getCourseTransactionReport($course, $id, $rate, $tglAwal, $tglAkhir,$start){
            $query = "SELECT tc.id_transaksi_course, tc.tanggal_transaksi_course,
                            c.tarif, tc.saldo_awal, tc.saldo_akhir,
                            c.nama_course
                    FROM transaksi_course tc INNER JOIN
                        courses c ON tc.id_courses =
                        c.id_courses                   
                    ";


            $cekFilter = 0;
            //cek filter course
            if($course != ""){
                $query .= " WHERE c.nama_course LIKE '%$course%'";
                $cekFilter = 1;
            }

            //cek filter id
            if($id != ""){
                if($cekFilter == 0){
                    $query .= " WHERE tc.id_transaksi_course LIKE '%$id%'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND tc.id_transaksi_course LIKE '%$id%'";
                }
            }

            //cek filter harga
            if($rate != ""){
                if($cekFilter == 0){
                    $query .= " WHERE c.tarif LIKE '%$rate%'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND c.tarif LIKE '%$rate%'";
                }
            }

            //cek filter range tgl 
            if($tglAwal != ""){
                if($cekFilter == 0){
                    if($tglAkhir != ""){
                        $query .= " WHERE tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAkhir != ""){
                        $query .= " AND tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }
            }else if($tglAkhir != ""){
                if($cekFilter == 0){
                    if($tglAwal != ""){
                        $query .= " WHERE tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_course <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAwal != ""){
                        $query .= " AND tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_course <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }
            }
            $query .= " LIMIT 5 OFFSET $start";
            $queryResult = $this->db->executeSelectQuery($query);
            // var_dump($queryResult);
            // die;
            $result = [];
            foreach($queryResult as $key => $value) {
                $result[] = new TransactionCourseReport($value['id_transaksi_course'], $value['tanggal_transaksi_course'], $value['tarif'], $value['saldo_awal'], $value['saldo_akhir'], $value['nama_course']);
            }
            return $result;
        }

        public function getCourseTransactionReport2($course, $id, $rate, $tglAwal, $tglAkhir){
            $query = "SELECT tc.id_transaksi_course, tc.tanggal_transaksi_course,
                            c.tarif, tc.saldo_awal, tc.saldo_akhir,
                            c.nama_course
                    FROM transaksi_course tc INNER JOIN
                        courses c ON tc.id_courses =
                        c.id_courses                   
                    ";


            $cekFilter = 0;
            //cek filter course
            if($course != ""){
                $query .= " WHERE c.nama_course LIKE '%$course%'";
                $cekFilter = 1;
            }

            //cek filter id
            if($id != ""){
                if($cekFilter == 0){
                    $query .= " WHERE tc.id_transaksi_course LIKE '%$id%'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND tc.id_transaksi_course LIKE '%$id%'";
                }
            }

            //cek filter harga
            if($rate != ""){
                if($cekFilter == 0){
                    $query .= " WHERE c.tarif LIKE '%$rate%'";
                    $cekFilter = 1;
                }else{
                    $query .= " AND c.tarif LIKE '%$rate%'";
                }
            }

            //cek filter range tgl 
            if($tglAwal != ""){
                if($cekFilter == 0){
                    if($tglAkhir != ""){
                        $query .= " WHERE tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAkhir != ""){
                        $query .= " AND tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }
                }
            }else if($tglAkhir != ""){
                if($cekFilter == 0){
                    if($tglAwal != ""){
                        $query .= " WHERE tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " WHERE tanggal_transaksi_course <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }else{
                    if($tglAwal != ""){
                        $query .= " AND tanggal_transaksi_course <= '$tglAkhir' AND tanggal_transaksi_course >= '$tglAwal'";
                        $cekFilter = 1;
                    }else{
                        $query .= " AND tanggal_transaksi_course <= '$tglAkhir'";
                        $cekFilter = 1;
                    }
                }
            }

            $queryResult = $this->db->executeSelectQuery($query);
            // var_dump($queryResult);
            // die;
            $result = [];
            foreach($queryResult as $key => $value) {
                $result[] = new TransactionCourseReport($value['id_transaksi_course'], $value['tanggal_transaksi_course'], $value['tarif'], $value['saldo_awal'], $value['saldo_akhir'], $value['nama_course']);
            }
            return $result;
        }
        public function getTransactionReport_filter(){
            $course = $_GET['course'];
            $id = $_GET['id'];
            $rate = $_GET['rate'];
            $tglAwal= $_GET['tglAwal'];
            $tglAkhir= $_GET['tglAkhir'];

            $result = $this->getCourseTransactionReport2($course, $id, $rate, $tglAwal, $tglAkhir,0);
            return View::createViewFilter('ajaxCourseTransactionReport.php',[
                "result"=>$result
            ]);
        }

        public function view_courseTransactionReport(){
            $start = 0;

            //di page ke 'start'
            if(isset($_GET['start']) && $start != ""){
                //5 = jumlah data di 1 page
                $start = $_GET['start'];
                $indexStart = (($start-1)*5)+1;
                $result = $this->getCourseTransactionReport("","","","","",$indexStart);
            
            //awal
            }else{
                $indexStart = 0;
                $result = $this->getCourseTransactionReport("", "", "","","", $start);
            }

            $resultSize = count($result);
            $query = "SELECT COUNT(id_transaksi_course) AS 'jmlh'
                      FROM transaksi_course
                     ";
            $ress = $this->db->executeSelectQuery($query)[0]['jmlh'];
            $jumlahPage = ($ress/5)+1;
            
            return View::createView('reportCourseTransaction.php', [
                "result"=>$result,
                "jmlhPage"=>$jumlahPage,
                "indexStart"=>$indexStart
            ]);
        }
//-----------------------------------------------------PDF Reporting
        public function generateReportCourse(){
            require_once "fpdf183/fpdf.php";
            $pdf = new FPDF('L', 'mm', 'A4');
            $pdf->AddPage();
            //judul
            $pdf->SetFont('Arial','B', 20);
            $pdf->Cell(277,15,"Studie Kuy!", 0, 1,'C');
            //nama report
            $pdf->SetFont('Arial','B', 16);
            $pdf->Cell(277,10,"Course Report",0,1,'C');
            $pdf->Cell(277,15,"",0,1,'C');
            //buat tabel judul
            $pdf->SetFont('Arial','B', 10);
            $pdf->Cell(13,10,"No.",1,0,'C');
            $pdf->Cell(30,10,"Nama",1,0,'C');
            $pdf->Cell(30,10,"Nilai Akhir",1,0,'C');
            $pdf->Cell(34,10,"Status Ketuntasan",1,0,'C');
            $pdf->Cell(34,10,"Status Verifikasi",1,0,'C');
            $pdf->Cell(32,10,"Tanggal Tuntas",1,0,'C');
            $pdf->Cell(34,10,"Nama Course",1,0,'C');
            $pdf->Cell(38,10,"Syarat Nilai Minimum",1,0,'C');
            $pdf->Cell(32,10,"Nama Bidang",1,1,'C');
            //tabel isi
            $pdf->SetFont('Arial','', 8);
            //dummy isi
            // $n=100;
            // for($i=0;$i<$n;$i++){
                // $pdf->Cell(17,10,"No.",1,0,'C');
                // $pdf->Cell(30,10,"Stanislaus Dendrio",1,0,'C');
                // $pdf->Cell(30,10,"Nilai Akhir",1,0,'C');
                // $pdf->Cell(34,10,"Status Ketuntasan",1,0,'C');
                // $pdf->Cell(34,10,"Status Verifikasi",1,0,'C');
                // $pdf->Cell(32,10,"Tanggal Tuntas",1,0,'C');
                // $pdf->Cell(30,10,"Nama Course",1,0,'C');
                // $pdf->Cell(38,10,"Syarat Nilai Minimum",1,0,'C');
                // $pdf->Cell(32,10,"Nama Bidang",1,1,'C');
            // }
            $result = $this->getCourseReport2("", "", "", 0);
            $nomor = 1;
            foreach($result as $key => $row){
                $pdf->Cell(13,10,$nomor,1,0,'C');
                $pdf->Cell(30,10,$row->getRealName(),1,0,'C');

                if($row->getNilaiAkhir()==NULL){
                    $pdf->Cell(30,10,"-",1,0,'C');
                }
                else{
                    $pdf->Cell(30,10,$row->getNilaiAkhir(),1,0,'C');
                }
                
                $pdf->Cell(34,10,$row->getStatusKetuntasan(),1,0,'C');

                if($row->getStatusVerifikasi()==NULL){
                    $pdf->Cell(34,10,"-",1,0,'C');
                }
                else{
                    $pdf->Cell(34,10,$row->getStatusVerifikasi(),1,0,'C');
                }
                
                if($row->getTanggalTuntas()==NULL){
                    $pdf->Cell(32,10,"-",1,0,'C');
                }
                else{
                    $pdf->Cell(32,10,$row->getTanggalTuntas(),1,0,'C');
                }
                
                $pdf->Cell(34,10,$row->getNamaCourse(),1,0,'C');
                $pdf->Cell(38,10,$row->getBatasNilai(),1,0,'C');
                $pdf->Cell(32,10,$row->getNamaBidang(),1,1,'C');
                $nomor++;
            }
            // var_dump($result);
            // die;
            $pdf->Output('I','CourseReportStudieKuy!.pdf');
            
        }
        public function generateReportTransactionCourse(){
            require_once "fpdf183/fpdf.php";
            $pdf = new FPDF('L', 'mm', 'A4');
            $pdf->AddPage();
            //judul
            $pdf->SetFont('Arial','B', 20);
            $pdf->Cell(277,15,"Studie Kuy!", 0, 1,'C');
            //nama report
            $pdf->SetFont('Arial','B', 16);
            $pdf->Cell(277,10,"Course Transaction Report",0,1,'C');
            $pdf->Cell(277,15,"",0,1,'C');
            //buat tabel judul
            $pdf->SetFont('Arial','B', 12);
            $pdf->Cell(17,10,"No.",1,0,'C');
            $pdf->Cell(42,10,"Id Transaksi",1,0,'C');
            $pdf->Cell(42,10,"Tanggal",1,0,'C');
            $pdf->Cell(42,10,"Harga Course",1,0,'C');
            $pdf->Cell(42,10,"Saldo Awal",1,0,'C');
            $pdf->Cell(42,10,"Saldo Akhir",1,0,'C');
            $pdf->Cell(50,10,"Nama Course",1,1,'C');
            //tabel isi
            $pdf->SetFont('Arial','', 10);
            $result = $this->getCourseTransactionReport2("", "", "", "", "", 0);
            $nomor = 1;
            foreach($result as $key => $row){
                $pdf->Cell(17,10,$nomor,1,0,'C');
                $pdf->Cell(42,10,$row->getIdTransaksi(),1,0,'C');
                $pdf->Cell(42,10,$row->getTanggal(),1,0,'C');
                $pdf->Cell(42,10,$row->getHarga(),1,0,'C');
                $pdf->Cell(42,10,$row->getSaldoAwal(),1,0,'C');
                if($row->getSaldoAkhir()==0.000){
                    $pdf->Cell(42,10,0,1,0,'C');
                }
                else{
                    $pdf->Cell(42,10,$row->getSaldoAkhir(),1,0,'C');
                }
                $pdf->Cell(50,10,$row->getNamaCourse(),1,1,'C');
                $nomor++;
            }
            $pdf->Output('I','CourseTransactionReportStudieKuy!.pdf');
        }
        public function generateTopUp(){
            require_once "fpdf183/fpdf.php";
            $pdf = new FPDF('L', 'mm', 'A4');
            $pdf->AddPage();
            //judul
            $pdf->SetFont('Arial','B', 20);
            $pdf->Cell(277,15,"Studie Kuy!", 0, 1,'C');
            //nama report
            $pdf->SetFont('Arial','B', 16);
            $pdf->Cell(277,10,"Top Up Report",0,1,'C');
            $pdf->Cell(277,15,"",0,1,'C');
            //buat tabel judul
            $pdf->SetFont('Arial','B', 12);
            $pdf->Cell(17,10,"No.",1,0,'C');
            $pdf->Cell(42,10,"Id Transaksi",1,0,'C');
            $pdf->Cell(42,10,"Tanggal",1,0,'C');
            $pdf->Cell(42,10,"Top Up",1,0,'C');
            $pdf->Cell(42,10,"Saldo Awal",1,0,'C');
            $pdf->Cell(42,10,"Saldo Akhir",1,0,'C');
            $pdf->Cell(50,10,"Verifikasi",1,1,'C');
            $pdf->SetFont('Arial','', 10);
            $result = $this->getTopUpReport2("", "", "", "", 0);
            $nomor = 1;
            foreach($result as $key => $row){
                $pdf->Cell(17,10,$nomor,1,0,'C');
                $pdf->Cell(42,10,$row->getIdTopUp(),1,0,'C');
                $pdf->Cell(42,10,$row->getTanggalTopUp(),1,0,'C');
                if($row->getNominal()==0.000){
                    $pdf->Cell(42,10,0,1,0,'C');
                }
                else{
                    $pdf->Cell(42,10,$row->getNominal(),1,0,'C');
                }
                
                if($row->getSaldoAwal()==0.000){
                    $pdf->Cell(42,10,0,1,0,'C');
                }
                else{
                    $pdf->Cell(42,10,$row->getSaldoAwal(),1,0,'C');
                }
                
                if($row->getSaldoAkhir()==0.000){
                    $pdf->Cell(42,10,0,1,0,'C');
                }
                else{
                    $pdf->Cell(42,10,$row->getSaldoAkhir(),1,0,'C');
                }
                
                if($row->getStatusVerifikasi()== 0){
                    $pdf->Cell(50,10,"Rejected",1,1,'C');
                }
                else if($row->getStatusVerifikasi()== 1){
                    $pdf->Cell(50,10,"Verified",1,1,'C');
                }
                else{
                    $pdf->Cell(50,10,"Not Verified Yet",1,1,'C');
                }
                
                $nomor++;
            }
            $pdf->Output('I','TopUpReportStudieKuy!.pdf');
        }

        //transaction course chart
        public function showTransactionCourseChart(){
            $query = "SELECT c.nama_course, COUNT(id_member) AS 'jumlah'
                      FROM transaksi_course tc INNER JOIN courses c
                      ON tc.id_courses = c.id_courses
                      GROUP BY c.nama_course";
            $result = $this->db->executeSelectQuery($query);

            return View::createViewChart('chartTransactionCourse.php',[
                "result"=>$result
            ]);
        }


        //coure report chart
        public function showCourseChart(){
            $query = "SELECT c.nama_course, AVG(mc.nilai_akhir) AS 'rata2'
                      FROM member_course mc INNER JOIN courses c
                      ON mc.id_courses = c.id_courses
                      GROUP BY c.nama_course";
            $result = $this->db->executeSelectQuery($query);
            return View::createViewChart('chartCourse.php',[
                "result"=>$result
            ]);
        }
        //top up report chart
        public function showTopupChart(){
            $query = "SELECT tanggal_transaksi_saldo, SUM(nominal_pengisian) AS 'total'
                      FROM transaksi_saldo
                      GROUP BY tanggal_transaksi_saldo";
            $result = $this->db->executeSelectQuery($query);

            return View::createViewChart('chartTopup.php',[
                "result"=>$result
            ]);
        }
    }
?>