<?php 
    class Kota {
        protected $idKota, $namaKota;

        public function __construct($idKota, $namaKota){
            $this->idKota = $idKota;
            $this->namaKota = $namaKota;
        }

        public function getIdKota(){
            return $this->idKota;
        }

        public function getNamaKota(){
            return $this->namaKota;
        }
    }
?>