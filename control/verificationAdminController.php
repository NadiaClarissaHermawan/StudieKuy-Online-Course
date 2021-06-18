<?php 
    require_once "control/services/viewVerificationAdmin.php";
    require_once "control/services/mysqlDB.php";

    class verificationAdminController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_verifpageAdmin(){
            return View::createView('verificationAdmin.php', []);
        }
    }
?>