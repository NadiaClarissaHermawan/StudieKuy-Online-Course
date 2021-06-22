<?php
    class ListMemberCourse{
        protected $id_memCourse, $id_course, $nama_course;

        public function __construct($id_memCourse, $id_course, $nama_course){
            $this->id_memCourse = $id_memCourse;
            $this->id_course = $id_course;
            $this->nama_course = $nama_course;
        }

        public function getIdMemCourse(){
            return $this->id_memCourse;
        }
        public function getIdCourse(){
            return $this->id_course;
        }
        public function getNamaCourse(){
            return $this->nama_course;
        }

    }
?>