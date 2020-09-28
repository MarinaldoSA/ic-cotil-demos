<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferramenta de testes: XSS</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-- navbar -->
<nav class="navbar fixed-top navbar-default navbar-expand-lg navbar-dark">

<a class="navbar-brand" href="index.php">Cross-site Scripting</a>
<button id="toggle-drpopdown" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<!-- navbarSupportedContent -->
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php
        if(isset($_SESSION['username'])){
            echo '
            <li class="nav-item">
                <a class="nav-link" href="comentarios_seguro.php">Demo XSS seguro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="comentarios_inseguro.php">Demo XSS inseguro</a>
            </li>
            ';
        }
    ?>
    </ul>
    <?php
        if(!isset($_SESSION['username'])){
            echo '
            <form class="form-inline my-2 my-lg-0">
                <a href="login.php"><button id="login" class="btn btn-outline-success my-2 my-sm-0" type="button">Login</button></a>
                <a href="cadastro.php"><button id="cadastro" class="btn btn-outline-success my-2 my-sm-0" type="button">Cadastro</button></a>
            </form>
            ';
        } else {
            echo '
            <span class="logged-in" style="color: green; margin-right: 10px;">Logado como <strong>' . $_SESSION['username'] . '</strong></span>
            <form class="form-inline my-2 my-lg-0">
                <a href="logout.php"><button id="sair" class="btn btn-outline-danger my-2 my-sm-0" type="button">Sair</button></a>
            </form>
            ';
        }
    ?>
</div>
<!-- navbarSupportedContent -->

</nav>
<!-- navbar -->
