<?php
    class Teacher {
        protected $realname, $username, $email, $password, $pendidikan_terakhir, $profpic, $alamat, $kontak;

        public function __construct($realname, $username, $email, $password, $pendidikan_terakhir, $profpic, $alamat, $kontak){
            $this->realname = $realname;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->pendidikan_terakhir = $pendidikan_terakhir;
            $this->profpic = $profpic;
            $this->alamat = $alamat;
            $this->kontak = $kontak;
        }

        public function getRealname(){
            return $this->realname;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getEmail(){
            return $this->email;
        }
        
        public function getPassword(){
            return $this->password;
        }

        public function getPendidikanTerakhir(){
            return $this->pendidikan_terakhir;
        }

        public function getProfpic(){
            return $this->profpic;
        }

        public function getAlamat(){
            return $this->alamat;
        }

        public function getKontak(){
            return $this->kontak;
        }
    }

?>