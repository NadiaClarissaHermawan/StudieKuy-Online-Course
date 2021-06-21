<?php
    class Admin {
        protected $username, $realname, $password, $email, $profpic;

        public function __construct($username, $realname, $password, $email, $profpic){
            $this->username = $username;
            $this->realname = $realname;
            $this->password = $password;
            $this->email = $email;
            $this->profpic = $profpic;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getRealname(){
            return $this->realname;
        }
        
        public function getPassword(){
            return $this->password;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getProfpic(){
            return $this->profpic;
        }
    }

?>