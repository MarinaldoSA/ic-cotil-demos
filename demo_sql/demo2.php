<?php
session_start();
?>
<?php
require_once "settings.php";

if(isset($_POST['usuario']) and isset($_POST['senha'])) {
    try{
        $dsn = "mysql:host=".$db["host"].";dbname=".$db["dbname"];
        $conn = new PDO("mysql:".$dsn,$db["username"],$db["password"]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $ex){
        echo "Falha ao conectar o banco de dados!<br>";
        echo $ex->getMessage();
        exit(1);
    }
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
    $query = "select * from usuario where email='$usuario' and senha='$senha'";
    $result = $conn->query($query);
    if($row=$result->fetch(PDO::FETCH_ASSOC))
    {
        $_SESSION['logado']=true;
        $_SESSION['nome']=$row['nome'];
        $_SESSION['email']=$row['email'];
        echo 'Carregando sistema, aguarde...';
        header( "refresh:2 url=index.php" );
        exit(0);
}
    else
    {
        echo "Usuario/Senha inválido!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css.css">
</head>
<body>
<form method="POST">
  <div class="container-fluid" id="top">
  <h1>UNICAMP - COTIL - 2019</h1>
        <br>
        <h2>Demonstração de SQL Injection</h2>
        <br>   
  </div>
  <div class="container" id="login" style="background-color: white; margin-top: 13%;padding-top: 15px; padding-bottom: 15px;">
    <div class="row align-items-center">
        <div class="col-md-4">
        <img src="imagens/logo_cotil.png">
        </div>
    
    <div class="col-md-4">
        Email:<br>
        <input type="text" name="usuario" autocomplete="off"><br><br>
        Senha:<br>
        <input type="password" name="senha"><br><br>
        <input type="submit" value="Entrar" class="button">
    </div>

    <div class="col-md-4">
            <img src="imagens/logo_unicamp.jpg">
    </div>
</div>
</div>
  </div>
  <a href="home.html" style="margin-bottom: 0px; margin-right: 0px; color: #0D1F26; ">IIIIIIIIIIIIII</a>
</form>
</body>
</html>