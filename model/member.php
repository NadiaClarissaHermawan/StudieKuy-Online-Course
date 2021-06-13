<?php
    class Member {
        protected $username, $password, $email, $phone, $address, $saldo;

        public function __construct($username, $password, $email, $phone, $address, $saldo){
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->phone = $phone;
            $this->address = $address;
            $this->saldo = $saldo;
        }

        public function getUsername(){
            return $this->username;
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
    }

?>