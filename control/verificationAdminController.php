<?php 
    require_once "control/services/viewVerificationAdmin.php";
    require_once "control/services/mysqlDB.php";

    class verificationAdminController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        //tampilan menu 
        public function view_verifpageAdmin(){
            return View::createView('verificationAdmin.php', []);
        }

        public function view_verifSertif(){
            return View::createViewVerification('verificationSertif.php', []);
        }

        public function view_verifCourse(){
           return View::createViewVerification('verificationCourse.php', []);
        }

        public function view_verifTopUp(){
            return View::createViewVerification('verificationTopUp.php', []);
        }
    }
?>