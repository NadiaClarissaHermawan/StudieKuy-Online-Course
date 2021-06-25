<?php
    class Teacher {
        protected $realname, $username, $email, $password, $pendidikan_terakhir, $profpic;

        public function __construct($realname, $username, $email, $password, $pendidikan_terakhir, $profpic){
            $this->realname = $realname;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->pendidikan_terakhir = $pendidikan_terakhir;
            $this->profpic = $profpic;
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
    }

?>