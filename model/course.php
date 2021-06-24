<?php 
    class Course{
        protected $id_course, $tarif, $batas_nilai_minimum, $keterangan_course, $gambar_course;
            
        public function __construct($id_course, $tarif, $batas_nilai_minimum, $keterangan_course, $gambar_course){
            $this->id_course = $id_course;
            $this->tarif = $tarif;
            $this->batas_nilai_minimum = $batas_nilai_minimum;
            $this->keterangan_course = $keterangan_course;
            $this->gambar_course =$gambar_course;
        }

        public function getIdCourse(){
            return $this->id_course;
        }

        public function getTarif(){
            return $this->tarif;
        }

        public function getBatasNilaiMinimum(){
            return $this->batas_nilai_minimum;
        }

        public function getKeterangan(){
            return $this->keterangan_course;
        }

        public function getGambarCourse(){
            return $this->gambar_course;
        }
    }
?>