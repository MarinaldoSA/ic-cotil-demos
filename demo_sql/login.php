<?php
session_start();
if(isset($_SESSION['logado'])){
    header('Location: index.php');
    exit(1);
}

require_once "settings.php";

$usuario = filter_input(INPUT_POST,"usuario", FILTER_SANITIZE_EMAIL	);
$senha = filter_input(INPUT_POST,"senha", FILTER_SANITIZE_STRING);

if($usuario!=NULL and $senha!=NULL)
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        try{
            $dsn = "mysql:host=".$db["host"].";dbname=".$db["dbname"];
            $conn = new PDO("mysql:".$dsn,$db["username"],$db["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $ex){
            echo "Falha ao conectar o banco de dados!<br>";
            echo $ex->getMessage();
            exit(1);
        }
        $query = "select * from usuario where email=:email and senha=:senha";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email',$usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha',$senha, PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetchObject()) {
            $_SESSION['logado']=true;
            $_SESSION['nome']=$row->nome;
            $_SESSION['email']=$row->email;
            echo 'Carregando sistema, aguarde...';
            header( "refresh:2; url=index.php" ); 
            exit(0);
        }else{
            echo 'Usuario/Senha inválido!';
        }

    }else{
        echo "Usuário não cadastrado!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Seguro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css.css">
</head>
<body>
<form method="POST">
  <div class="container-fluid" id="top">
    <h1>Login Seguro</h1><br>
  </div>
  <div class="container" id="login" style="background-color: white; margin-top: 13%;padding-top: 15px; padding-bottom: 15px;">
    <div class="row align-items-center">
        <div class="col-md-4">
        <img src="imagens/logo_cotil.png">
        </div>
    
    <div class="col-md-4">
        Email:<br>
        <input type="text" name="usuario"
        autocomplete="off"><br><br>
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
  </form>
  <a href="index.php" style="margin-bottom: 0px; margin-right: 0px; color: #0D1F26; ">IIIIIIIIIIIIII</a>

</body>
</html>