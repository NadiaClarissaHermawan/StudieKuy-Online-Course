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

            //topup button
            if(isset($nominal) && $nominal!=""){
                $result = $this->getSaldoUser();
                return View::createViewConfirm('userTopupConfirmation.php', [
                    "result" => $result
                ], $nominal);

            //topup custom
            }else if(isset($nominalText) && $nominalText!=""){
                $result = $this->getSaldoUser();
                return View::createViewConfirm('userTopupConfirmation.php', [
                    "result" => $result
                ], $nominalText);
            }
        }
    }
?>