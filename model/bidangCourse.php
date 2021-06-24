<?php 
    class BidangCourse{
        protected $id_courses, $nama_course, $gambar_course;

        public function __construct($id_courses, $nama_course, $gambar_course){
            $this->id_courses = $id_courses;
            $this->nama_course = $nama_course;
            $this->gambar_course = $gambar_course;
        }

        public function getIdCourse(){
            return $this->id_courses;
        }

        public function getNamaCourse(){
            return $this->nama_course;
        }

        public function getGambarCourse(){
            return $this->gambar_course;
        }
    }
?>