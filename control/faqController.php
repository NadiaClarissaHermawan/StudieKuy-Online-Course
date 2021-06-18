<?php 
    require_once "control/services/viewFaq.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/saldo.php";

    class faqController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_faq(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            //sudah login
            if(isset($_SESSION['status'])){
                $id = $_SESSION['id_pengguna'];
                $query = "SELECT saldo 
                        FROM member 
                        WHERE id_pengguna = '$id'
                        ";
                $saldoUser = $this->db->executeSelectQuery($query);
                foreach($saldoUser as $key =>$value){
                    $result[] = new Saldo($value['saldo']);
                }
                return View::createView('faq.php', [
                    "result" => $result
                ]);
            }
        }
    }
?>