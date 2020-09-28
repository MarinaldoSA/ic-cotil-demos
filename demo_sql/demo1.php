<?php
session_start();
if(isset($_POST['usuario']) and isset($_POST['senha'])) {
    $link = mysqli_connect("127.0.0.1", "root", "", "sqlinjection");
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$query = "select * from usuario where email='$usuario' and senha='$senha'";
    $result = mysqli_query($link, $query);
    if($result!=NULL){
        if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $_SESSION['logado']=true;
            $_SESSION['nome']=$row['nome'];
            $_SESSION['email']=$row['email'];
            echo 'Carregando sistema, aguarde...';
            header( "refresh:2; url=index.php" ); 
            exit(0);
        }
        else {
            echo "Usuário ou senha invalido!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Demonstrando SQL Injection - COTIL</title>
</head>
<body>
<form  method="POST">
  <h2>Demonstrando SQL Injection - COTIL</h2><br>
  Usuário:<br>
  <input type="text" name="usuario"><br><br>
  Senha:<br>
  <input type="text" name="senha"><br><br>
  <input type="submit" value="Logar">
</form>
<hr>
<form action="index.php" method="POST">
    <input type="submit" value="HOME">
</form>
</body>
</html>