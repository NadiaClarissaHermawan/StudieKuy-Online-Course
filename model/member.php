<?php
    class Member {
        protected $username, $realname, $password, $email, $phone, $address, $saldo, $profpic;

        public function __construct($username, $realname, $password, $email, $phone, $address, $saldo, $profpic){
            $this->username = $username;
            $this->realname = $realname;
            $this->password = $password;
            $this->email = $email;
            $this->phone = $phone;
            $this->address = $address;
            $this->saldo = $saldo;
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

        public function getPhone(){
            return $this->phone;
        }

        public function getAddress(){
            return $this->address;
        }

        public function getSaldo(){
            return $this->saldo;
        }

        public function getProfpic(){
            return $this->profpic;
        }
    }

?>