<?php
    session_start();
?>
<html>
<head>
    <title>title</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
     crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="container-fluid, cabecalho" id="top">
        <h1>UNICAMP - COTIL - 2019</h1>
        <br>
        <h2>Demonstração de SQL Injection</h2>
        <br>
    </div>

    <div style="color: green;">
    <?php
    if(isset($_SESSION['logado']))
    {
        echo '<p style="font-size: 20px; color: lightgreen;">Bem vindo, <b>',$_SESSION['nome'],'</b>. Logado como: <b>',$_SESSION['email'],'</b> </p>';
    }
    ?>
    </div>

    <div class="container" id="login" style="border-radius: 40px; margin-left: 5%; margin-right: 5%;">
        <form action="criaConta.php" method='post'>
            <input type="submit" value="Criar Conta" class="text">
        </form>
        <hr>
        <!--<form action="demo1.php" method='post'>
            <input type="submit" value="Login Inseguro (1)" class="text">
        </form>-->
        <form action="demo2.php" method='post'>
            <input type="submit" value="Login Inseguro" class="text">
        </form>
        <form action="login.php" method='post'>
            <input type="submit" value="Login Seguro" class="text">
        </form>
        <hr>
        <form action="logout.php" method='post'>
            <input type="submit" value="Logout" class="text" style="border-color: #990000; color: #990000;">
        </form>
    </div>
    <a href="home.html" style="margin-bottom: 0px; margin-right: 0px; color: #0D1F26; ">IIIIIIIIIIIIII</a>
</body>
</html>