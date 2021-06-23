<?php 
    class SoalUjian {
        protected $id_soal_ujian, $nomor_soal, $soal, $opsi1, $opsi2, $opsi3, $kunci_jawaban, $id_courses;

        public function __construct($id_soal_ujian, $nomor_soal, $soal, $opsi1, $opsi2, $opsi3, $kunci_jawaban, $id_courses){
            $this->id_soal_ujian = $id_soal_ujian;
            $this->nomor_soal = $nomor_soal;
            $this->soal = $soal;
            $this->opsi1 = $opsi1;
            $this->opsi2 = $opsi2;
            $this->opsi3 = $opsi3;
            $this->kunci_jawaban = $kunci_jawaban;
            $this->id_courses = $id_courses;
        }

        public function getIdSoal(){
            return $this->id_soal_ujian;
        }

        public function getNomorSoal(){
            return $this->nomor_soal;
        }

        public function getSoal(){
            return $this->soal;
        }

        public function getOpsi1(){
            return $this->opsi1;
        }
        public function getOpsi2(){
            return $this->opsi2;
        }
        public function getOpsi3(){
            return $this->opsi3;
        }
        public function getKunjaw(){
            return $this->kunci_jawaban;
        }
        public function getIdCourses(){
            return $this->id_courses;
        }
        

    }
?>