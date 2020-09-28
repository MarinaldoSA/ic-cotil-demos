<?php

    session_start();
    require_once 'vendor/autoload.php';

    $comentario = new \App\Model\Comentario($_SESSION['username']);
    $comentario_dao = new App\Model\ComentarioDao();

    if(isset($_POST['comment'])){
        $comentario->setComentario($_POST['comment']);
        $comentario_dao->create($comentario);
    }

    header("Location:comentarios_seguro.php");
