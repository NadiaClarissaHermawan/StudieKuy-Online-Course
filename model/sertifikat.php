<?php 
    class Sertifikat {
        protected $real_name, $tanggal, $nama_sertif;

        public function __construct($real_name, $tanggal, $nama_sertif){
            $this->real_name = $real_name;
            $this->tanggal = $tanggal;
            $this->nama_sertif = $nama_sertif;
        }

        public function getRealName(){
            return $this->real_name;
        }

        public function getTanggal(){
            return $this->tanggal;
        }

        public function getSertif(){
            return $this->nama_sertif;
        }
    }
?>