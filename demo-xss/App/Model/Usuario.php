<?php

    namespace App\Model;

    class Usuario {
        private $id;
        private $username;
        private $password;

        //getters
        public function getId(){
            return $this->id;
        }
        public function getUserName(){
            return $this->username;
        }
        public function getPassword(){
            return $this->password;
        }

        //setters
        public function setId($id){
            $this->id = $id;
        }
        public function setUserName($username){
            $this->username = $username;
        }
        public function setPassword($password){
            $this->password = $password;
        }
    }