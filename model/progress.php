<?php
    class Progress{
        protected $id_memCourse, $nilai_akhir, $status_ketuntasan, $tanggal_tuntas, $status_verifikasi;

        public function __construct($id_memCourse, $nilai_akhir, $status_ketuntasan, $tanggal_tuntas, $status_verifikasi){
            $this->id_memCourse = $id_memCourse;
            $this->nilai_akhir = $nilai_akhir;
            $this->status_ketuntasan = $status_ketuntasan;
            $this->tanggal_tuntas = $tanggal_tuntas;
            $this->status_verifikasi = $status_verifikasi;
        }

        public function getIdMemCourse(){
            return $this->id_memCourse;
        }

        public function getNilaiAkhir(){
            return $this->nilai_akhir;
        }
        public function getStatusKetuntasan(){
            return $this->status_ketuntasan;
        }
        public function getTanggal(){
            return $this->tanggal_tuntas;
        }

        public function getStatusVerifikasi(){
            return $this->status_verifikasi;
        }
    }
?>