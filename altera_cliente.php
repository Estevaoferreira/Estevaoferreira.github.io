<?php
include 'conexao.php';
$cod_clientes=$_GET['cod'];
$acao=$_GET['acao'];



switch ($acao) {
  case 'altera':
  $nome=$_POST['nome'];
  $telefone=$_POST['telefone'];
  $email=$_POST['email'];
  $logradouro=$_POST['logradouro'];
  $numero_imovel=$_POST['numero_imovel'];
  $pais=$_POST['pais'];
  $estado=$_POST['estado'];
  $cidade=$_POST['cidade'];
  $bairro=$_POST['bairro'];
  $complemento=$_POST['complemento'];
  $cep=$_POST['cep'];




  $sql= $conexao->query("UPDATE clientes_usuario SET
    nome='$nome',
    telefone='$telefone',
    email='$email',
    logradouro='$logradouro',
    numero_imovel='$numero_imovel',
    pais='$pais',
    estado='$estado',
    cidade='$cidade',
    bairro='$bairro',
    complemento='$complemento',
    CEP='$cep'
    WHERE cod_clientes='$cod_clientes'");
    break;

    case 'remove':
    $sql = $conexao->query("DELETE FROM estoque_produtos
      WHERE cod_produto='$cod_prod'");
      break;

    }


    header('Location: clientes_usuario.php');
    ?>
