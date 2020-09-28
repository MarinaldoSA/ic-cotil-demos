<?php

  session_start();

  if(!isset($_SESSION['username'])){
    header('Location:index.php');
  }

  require_once 'vendor/autoload.php';
  require 'autoload/header.php';

  $comentario_dao = new App\Model\ComentarioDao();

?>

<section class="main">
  <div class="jumbotron jumbotron-fluid text-center">
      <div class="container">
          <h1 class="display-4">Comentários <strong>(inseguro)</strong></h1>
          <p class="lead">Faça aqui os seus comentários</p>
      </div>
  </div>
    <!-- container -->
    <div class="container-fluid">

    <!-- row -->
    <div class="row">
    <div class="col-sm-3"></div>


        <div class="col-md-6">

            <!-- form -->
            <form action="comentou_inseguro.php" method="POST" class='envia-comentario'>
                <div class="form-group">
                    <label for="inputComment">Comentário</label>
                    <input name="comment" type="text" class="form-control" id="inputUserName" aria-describedby="emailHelp" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success">Enviar!</button>
            </form>
            <!-- form -->

            <!-- form -->
            <form action="exclui_comentarios.php" class='exclui-comentario'>
                <button type="submit" class="btn btn-danger">Excluir todos os comentários</button>
            </form>
            <!-- form -->

            <?php
                $comentarios_conteudo = $comentario_dao->read();
                if($comentarios_conteudo != NULL){

                    foreach($comentarios_conteudo as $conteudo){

                        $usuario = $comentario_dao->readUser($conteudo['idusuario']);

                        echo "<div class='container-fluid comments'><strong>" . $usuario[0]['username'] . "</strong> comentou: ${conteudo['comentario']}</div><br/>";
                    }
                }
            ?>

        </div>

        <div class="col-md-3"></div>
    </div>
    <!-- row -->

    </div>
    <!-- container -->
</section>

<?php require 'autoload/footer.php' ?>
