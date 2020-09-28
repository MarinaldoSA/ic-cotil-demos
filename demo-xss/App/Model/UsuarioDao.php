<?php

    namespace App\Model;

    class UsuarioDao {
        public function create(Usuario $user){
            $sql = 'INSERT INTO usuarios (username, password) VALUES (?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->bindValue(1, $user->getUserName());
            $stmt->bindValue(2, $user->getPassword());

            $stmt->execute();
        }
        public function read($username){
            $sql = "SELECT * FROM usuarios WHERE username='${username}'";

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $username);

            $stmt->execute();

            if($stmt->rowCount() > 0):
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            endif;
        }
    }