<?php
include 'conexao.php';
$cod_prod=$_GET['cod'];
$acao=$_GET['acao'];



switch ($acao) {
  case 'altera':
  $nome=$_POST['nome'];
  $preco=$_POST['preco'];
  $qntd=$_POST['quantidade'];
  $sql= $conexao->query("UPDATE estoque_produtos SET
    nome='$nome',
    quantidade='$qntd',
    preco='$preco'
    WHERE cod_produto='$cod_prod'");
    break;

    case 'remove':
    $sql = $conexao->query("DELETE FROM estoque_produtos
      WHERE cod_produto='$cod_prod'");
      break;

    }


    header('Location: dashboard.php');
    ?>
