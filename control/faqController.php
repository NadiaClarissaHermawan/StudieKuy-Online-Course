<?php 
    require_once "control/services/viewFaq.php";
    require_once "control/services/mysqlDB.php";

    class faqController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_faq(){
            return View::createView('faq.php', []);
        }
    }
?>