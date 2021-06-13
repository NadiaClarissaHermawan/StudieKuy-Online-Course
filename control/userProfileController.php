<?php 
    session_start();
    require_once "control/services/viewUserProfile.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/member.php";

    class userProfileController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_userProfile(){
            return View::createView('userProfile.php', []);
        }
    }
?>
