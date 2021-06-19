<?php 
    session_start();
    require_once "control/services/viewUserTopup.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/saldo.php";

    class userTopupController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_userTopup(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
            $saldoUser = $this->db->executeSelectQuery($query);
            foreach($saldoUser as $key =>$value){
                $result[] = new Saldo($value['saldo']);
            }
            return View::createView('userTopup.php', [
                "result" => $result
            ]);
        }

        public function topupSaldo(){
            //lengkapin nnti buat klik / fix topup saldo
        }
    }
?>