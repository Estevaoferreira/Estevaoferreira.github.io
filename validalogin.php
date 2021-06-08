<?php
session_start();
include 'conexao.php';

if (empty($_POST['email']) || empty($_POST['senha'])) {
  header('Location: signin.php');
  exit();
}


$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha =mysqli_real_escape_string($conexao, trim($_POST['senha']));

$query = "SELECT email,senha,nome,cod FROM usuarios WHERE email='$email' and senha = md5('$senha')";

$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);
if ($row == 1) {
  $_SESSION['usuario'] = $email;
  while ($obj=$result->fetch_object()) {
    $nome=$obj->nome;
    $cod=$obj->cod;
  }
  $_SESSION['cod']=$cod;
  $_SESSION['nome']=$nome;
  header('Location: dashboard.php');
  exit();
}else {
  header('Location: signin.php');
  exit();
}
?>
