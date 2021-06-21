<?php 
    class SertificateRequest {
        protected $real_name, $nilai_akhir, $nama_course, $batas_nilai_minimum, $nama_bidang, $status, $idmemCourse;

        public function __construct($real_name, $nilai_akhir, $nama_course, $batas_nilai_minimum, $nama_bidang, $status, $idmemCourse){
            $this->real_name = $real_name;
            $this->nilai_akhir = $nilai_akhir;
            $this->nama_course = $nama_course;
            $this->batas_nilai_minimum = $batas_nilai_minimum;
            $this->nama_bidang = $nama_bidang;
            $this->status = $status;
            $this->idmemCourse = $idmemCourse;
        }

        public function getRealName(){
            return $this->real_name;
        }

        public function getNilaiAkhir(){
            return $this->nilai_akhir;
        }
        public function getNamaCourse(){
            return $this->nama_course;
        }
        public function getBatasNilai(){
            return $this->batas_nilai_minimum;
        }
        public function getNamaBidang(){
            return $this->nama_bidang;
        }

        public function getStatus(){
            return $this->status;
        }
        public function getIdMemCourse(){
            return $this->idmemCourse;
        }
    }
?>