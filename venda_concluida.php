<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
if(!isset($_SESSION["usuario"])) {header("location:index.php");}
include 'conexao.php';
date_default_timezone_set('America/Sao_paulo');

$conexao->close();

?>
