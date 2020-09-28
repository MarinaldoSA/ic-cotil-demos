<?php

    require_once 'vendor/autoload.php';

    $comentario_dao = new App\Model\ComentarioDao();

    $comentario_dao->delete();

    header("Location:index.php");
