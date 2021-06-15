<?php 
    session_start();
    require_once "control/services/viewUserTopup.php";
    require_once "control/services/mysqlDB.php";

    class userTopupController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_userTopup(){
            return View::createView('userTopup.php', []);
        }

        public function topupSaldo(){
            //lengkapin nnti buat klik / fix topup saldo
        }
    }
?>