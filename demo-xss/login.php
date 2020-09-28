<?php
    session_start();

    if(isset($_SESSION['username'])){
        header('Location:index.php');
    }

    require_once 'vendor/autoload.php';
    require 'autoload/header.php';
?>

<section class="main">

    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4">Login</h1>
            <p class="lead">Faça seu login em nosso site.</p>
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
                        <input name="username-login" type="text" class="form-control" id="inputUserName" aria-describedby="emailHelp" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input name="senha-login" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-success">Logar!</button>
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

    if(isset($_POST['username-login']) && isset($_POST['senha-login'])){
        $usuarioDao = new \App\Model\UsuarioDao();

        if($usuarioDao->read($_POST['username-login']) != NULL){
            foreach($usuarioDao->read($_POST['username-login']) as $usuario){
                if($usuario['password'] == $_POST['senha-login']){
                    $_SESSION['username'] = $_POST['username-login'];
                    header('Location:index.php');
                }
            }
        }
    }

?>
