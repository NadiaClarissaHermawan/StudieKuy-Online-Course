<?php 
    require_once "control/services/viewVerificationTable.php";
    require_once "control/services/mysqlDB.php";

    class verificationTableController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_verifSertif(){
            return View::createView('verificationSertif.php', []);
        }
        public function view_verifCourse(){
           return View::createView('verificationCourse.php', []);
        }
        public function view_verifTopUp(){
            return View::createView('verificationTopUp.php', []);
        }
    }
?>