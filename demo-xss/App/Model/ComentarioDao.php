<?php

    namespace App\Model;

    class ComentarioDao {
        public function create(Comentario $comentario){
            $sql = 'INSERT INTO comentarios (idusuario, comentario) VALUES (?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->bindValue(1, $comentario->getIdUsuario());
            $stmt->bindValue(2, $comentario->getComentario());

            $stmt->execute();
        }
        public function read(){
            $sql = "SELECT * FROM comentarios";

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;
        }
        public function readUser($idusuario) {
            $sql = "SELECT username FROM usuarios WHERE idusuarios=" . $idusuario;

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }
        }
        public function delete(){
            $sql = "DELETE FROM comentarios";

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->execute();
        }
    }