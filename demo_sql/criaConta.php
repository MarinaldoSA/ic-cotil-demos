<?php
session_start();
if(isset($_SESSION['logado'])){
    session_destroy();
}

require_once "settings.php";

$nome = filter_input(INPUT_POST,"nome", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL	);
$senha = filter_input(INPUT_POST,"senha", FILTER_SANITIZE_STRING);

if($nome!=NULL and $email!=NULL and $senha!=NULL)
{
        try{
            $dsn = "mysql:host=".$db["host"].";dbname=".$db["dbname"];
            $conn = new PDO("mysql:".$dsn,$db["username"],$db["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO usuario (nome,email,senha) VALUES (:nome,:email,:senha)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
            $stmt->bindParam(':email',$email, PDO::PARAM_STR);
            $stmt->bindParam(':senha',$senha, PDO::PARAM_STR);
            $stmt->execute();
            if( $stmt->rowCount() > 0 ){
                echo "Conta criada com sucesso!";
                header( "refresh:2; url=index.php" ); 
                exit(0);    
            }    
        }catch(PDOException $ex){
            echo "Falha acessar o banco de dados!<br>";
            echo $ex->getMessage();
            exit(1);
        }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Demonstrando Injection - COTIL</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css.css">
</head>
<body>
  <div id="top">
      <h2>Crie sua conta</h2><br>
  </div>
 
  <div id="login">

  <div class="row align-items-center">

    <div class="col-md-4">
        <img src="imagens/logo_cotil.png">
    </div>

    <div class="col-md-4">
        <form method="POST">
        Nome:<br>
        <input type="text" name="nome" autocomplete="off"><br><br>

        Email:<br>
        <input type="text" name="email" autocomplete="off"><br><br>

        Senha:<br>
        <input type="password" name="senha"><br><br>

        <input type="submit" value="Registrar" class="button">
        </form>
    </div>  

    <div class="col-md-4">
            <img src="imagens/logo_unicamp.jpg">
    </div>
  </div>

  </div>


  <p style="color: lightgreen; text-align: center; font-size: 22px;"><b>*Aviso:</b> NÃO coloque email e senha verdadeiros, principalmente senha. Elas podem ser expostas, evite algo pior.</p>
  <a href="index.php" style="margin-bottom: 0px; margin-right: 0px; color: #0D1F26; ">IIIIIIIIIIIIII</a>
</body>
</html>