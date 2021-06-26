<?php 
    session_start();
    require_once "control/services/viewUserTopup.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/saldo.php";
    require_once "model/transaksi_saldo.php";

    class userTopupController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function getSaldoUser(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $id = $_SESSION['id_pengguna'];
            $query = "SELECT saldo 
                      FROM member 
                      WHERE id_pengguna = '$id'
                     ";
            $saldoUser = $this->db->executeSelectQuery($query);
            $result = [];
            foreach($saldoUser as $key =>$value){
                $result[] = new Saldo($value['saldo']);
            }
            return $result;
        }

        public function view_userTopup(){
            $result = $this->getSaldoUser();
            return View::createView('userTopup.php', [
                "result" => $result
            ]);
        }

        public function view_topupConfirm(){
            $nominal = $_GET['nominal'];
            $nominalText = $_GET['nominalText'];

            //topup custom
            if(isset($nominalText) && $nominalText!="" ){
                $nominalText = $nominalText/1000;
                $result = $this->getSaldoUser();
                return View::createViewConfirm('userTopupConfirmation.php', [
                    "result" => $result
                ], $nominalText);
            //topup button
            }else if(isset($nominal) && $nominal!=""){
                $result = $this->getSaldoUser();
                return View::createViewConfirm('userTopupConfirmation.php', [
                    "result" => $result
                ], $nominal);
            }
        }

        //upload foto bukti transfer
        public function topup(){
            if(isset($_FILES["file"])){
                //cari id_transaksi yg masih kosong
                $query = "SELECT id_transaksi_saldo
                          FROM transaksi_saldo
                          ORDER BY id_transaksi_saldo DESC
                         ";
                $id_kosong = $this->db->executeSelectQuery($query)[0]['id_transaksi_saldo'];

                $oldName = $_FILES["file"]["tmp_name"];
                //dirname => naik 1 directory
                //__DIR__ => directory file ini skrg (controller/Controller.php)
                $newName = dirname(__DIR__)."\\view\\images\\buktitransfer\\".$id_kosong.".jpg";
                if(move_uploaded_file($oldName, $newName)){
                    return '{"result":"'.$id_kosong.'"}';
                }else{
                    echo "Error in uploading";
                }	
            }
        }

        //fix top up saldo
        public function insert_log(){
            $id_pengguna = $_SESSION['id_pengguna'];
            $nominal = $_POST['nominal'];
            
            $saldo_awal = $this->getSaldoUser()[0]->getSaldo();
            $saldo_akhir = ($saldo_awal*1000) + ($nominal*1000);

            $saldo_akhir = $saldo_akhir/1000;

            $query = "SELECT id_member
                      FROM member
                      WHERE id_pengguna = '$id_pengguna'
                     ";
            $id_member = $this->db->executeSelectQuery($query)[0]["id_member"];
            $bukti_trf = $id_pengguna.".jpg";

            $query = "INSERT INTO transaksi_saldo
                      (saldo_awal, saldo_akhir, status_verifikasi, tanggal_transaksi_saldo, nominal_pengisian, id_member, bukti_trf)
                      VALUES 
                      ($saldo_awal, $saldo_akhir, 0, now(), $nominal, $id_member, '$bukti_trf')
                     ";
            $this->db->executeNonSelectQuery($query);
        }

        //notifikasi transaksi diproses
        public function view_process(){
            $result = $this->getSaldoUser();
            return View::createView('topupProcess.php', [
                "result"=>$result
            ]);
        }

        //lihat riwayat transaksi saldo user
        public function view_topupHistory(){
            $id_pengguna = $_SESSION['id_pengguna'];

            $query = "SELECT *
                      FROM transaksi_saldo t INNER JOIN member m
                      ON t.id_member = m.id_member
                      WHERE m.id_pengguna = '$id_pengguna'
                      ORDER BY t.id_transaksi_saldo DESC
                     ";
            $transaksi_user = $this->db->executeSelectQuery($query);
            
            $result = [];
            foreach($transaksi_user as $key =>$value){
                $result[] = new Transaksi_Saldo($value['saldo_awal'], $value['saldo_akhir'], $value['status_verifikasi'], $value['tanggal_transaksi_saldo'], $value['nominal_pengisian'], $value['saldo']);
            }
            
            if($result == null){
                $_SESSION['tempS'] = $this->getSaldoUser()[0];
            }

            return View::createView('topupHistory.php', [
                "result"=>$result
            ]);
        }
    }
?>