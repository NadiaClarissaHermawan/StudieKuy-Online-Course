<?php 
    class CourseReport{
        protected $real_name, $nilai_akhir, $status_ketuntasan, $status_verifikasi, $tanggal_tuntas, $nama_course, $batas_nilai_minimum, $nama_bidang;

        public function __construct($real_name, $nilai_akhir, $status_ketuntasan, $status_verifikasi, $tanggal_tuntas, $nama_course, $batas_nilai_minimum, $nama_bidang){
            $this->real_name = $real_name;
            $this->nilai_akhir = $nilai_akhir;
            $this->status_ketuntasan = $status_ketuntasan;
            $this->status_verifikasi = $status_verifikasi;
            $this->tanggal_tuntas = $tanggal_tuntas;
            $this->nama_course = $nama_course;
            $this->batas_nilai_minimum = $batas_nilai_minimum;
            $this->nama_bidang = $nama_bidang;
        }

        public function getRealName(){
            return $this->real_name;
        }

        public function getNilaiAkhir(){
            return $this->nilai_akhir;
        }

        public function getStatusKetuntasan(){
            return $this->status_ketuntasan;
        }

        public function getStatusVerifikasi(){
            return $this->status_verifikasi;
        }

        public function getTanggalTuntas(){
            return $this->tanggal_tuntas;
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
    }
?>