<?php
    session_start();

    if(isset($_SESSION['username'])){
        header('Location:index.php');
    }

    if(isset($_SESSION['username'])){
        header('Location:index.php');
    }

    require_once 'vendor/autoload.php';
    require 'autoload/header.php';

    $usuario = new \App\Model\Usuario();
?>

<section class="main">

    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4">Cadastro</h1>
            <p class="lead">Faça seu cadastro em nosso site.</p>
        </div>
    </div>

    <!-- container -->
    <div class="container-fluid">

        <!-- row -->
        <div class="row">
            <div class="col-sm-3"></div>


            <div class="col-md-6">

                <!-- form -->
                <form method="POST">
                    <div class="form-group">
                        <label for="inputUserName">Nome de usuário</label>
                        <input name="username" type="text" class="form-control" id="inputUserName" aria-describedby="emailHelp" autocomplete="off" required>
                        <small id="emailHelp" class="form-text text-muted">Nós não vamos compartilhar suas informações pessoais.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input name="senha" type="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Cadastrar!</button>
                </form>
                <!-- form -->

            </div>

            <div class="col-md-3"></div>
        </div>
        <!-- row -->

    </div>
    <!-- container -->

</section>

<?php

    require 'autoload/footer.php';

    if(isset($_POST['username']) && isset($_POST['senha'])){
        $usuarioDao = new \App\Model\UsuarioDao();

        if($usuarioDao->read($_POST['username']) == NULL){
            $usuario->setUserName($_POST['username']);
            $usuario->setPassword($_POST['senha']);

            $usuarioDao->create($usuario);
        }
    }

?>
