<?php
    require_once "control/services/viewTeacherLoginRegister.php";
    require_once "control/services/mysqlDB.php";
    require_once "model/kota.php";

    class registerTeacherController{
        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_registerTeacherUserPage(){
            $result = $this->getAllKota();
            return View::createView('userTeacherRegister.php', [
                "result"=>$result
            ]);
        }

        public function getAllKota(){
            $query = "  SELECT id_kota, nama_kota
                        FROM kota
                     ";
            $query_result = $this->db->executeSelectQuery($query);
            $result = [];
            foreach($query_result as $key => $value){
                $result[] = new Kota( $value['id_kota'], $value['nama_kota']);
            }
            return $result;
        }
    }
?>