<?php 
    class Modul {
        protected $nama_modul, $isi_modul, $keterangan_modul, $namaCourse, $id_courses;

        public function __construct($nama_modul, $isi_modul, $keterangan_modul, $namaCourse, $id_courses){
            $this->nama_modul = $nama_modul;
            $this->isi_modul = $isi_modul;
            $this->keterangan_modul = $keterangan_modul;
            $this->namaCourse = $namaCourse;
            $this->id_courses = $id_courses;
        }

        public function getNamaCourse(){
            return $this->namaCourse;
        }

        public function getIdCourse(){
            return $this->id_courses;
        }


        public function getNamaModul(){
            return $this->nama_modul;
        }

        public function getIsiModul(){
            return $this->isi_modul;
        }
        public function getKeteranganModul(){
            return $this->keterangan_modul;
        }
    }
?>