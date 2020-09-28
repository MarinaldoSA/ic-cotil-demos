<?php

    namespace App\Model;

    class Comentario {
        private $id;
        private $id_usuario;
        private $comentario;

        public function __construct($username){
            $usuario_dao = new \App\Model\UsuarioDao();

            if($usuario_dao->read($username) != NULL){
                $usuario = $usuario_dao->read($username);
                $this->setIdUsuario($usuario[0]['idusuarios']);
            }
        }

        //getters
        public function getComentario(){
            return $this->comentario;
        }
        public function getId(){
            return $this->id;
        }
        public function getIdUsuario(){
            return $this->id_usuario;
        }

        //setters
        public function setComentario($comentario){
            $this->comentario = $comentario;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function setIdUsuario($id_usuario){
            $this->id_usuario = $id_usuario;
        }

    }