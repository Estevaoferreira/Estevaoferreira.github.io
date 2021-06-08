<?php
date_default_timezone_set('America/Sao_paulo');
if(session_id() == '' || !isset($_SESSION)){session_start();}
if(!isset($_SESSION["usuario"])) {header("location:index.php");}
include 'conexao.php';
$acao=$_GET['endereco'];
$cod_usuario=$_SESSION['cod'];
$cod = $_SESSION['cod_cliente'];

$query = "SELECT * FROM clientes_usuario WHERE cod_clientes='$cod'";

$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
$cod_usuario=$_SESSION['cod'];
$sql_cliente="SELECT * FROM clientes_usuario WHERE cod_clientes ='$cod'";
$query_cliente=mysqli_query($conexao, $sql_cliente);
if ($acao=='nao') {
  $cod_usuario=$_SESSION['cod'];
  $sql_cliente="SELECT * FROM clientes_usuario WHERE cod_usuario ='$cod_usuario' AND cod_clientes=".$cod;
  $query_cliente=mysqli_query($conexao, $sql_cliente);
  while ($line = $query_cliente->fetch_object()) {
    $cod_cliente=$line->cod_clientes;
    $n_c=$line->nome;
    $email_c=$line->email;
    $fone_c=$line->telefone;
  }


  $data=date('Y/m/d H:i');
  $total=0;
#Insere na tabela clientes os dados informados com o codigo do usuario q cadastrou

  foreach($_SESSION['cart'] as $cod_prod => $qntd) {

    $result = $conexao->query("SELECT * FROM estoque_produtos WHERE cod_produto ='$cod_prod' AND cod_usuario='$cod_usuario'");

    if($result){

      if($obj = $result->fetch_object()) {

        $preco = $obj->preco * $qntd;
      $total = $total + $preco;#determina o preço TOTAL pago pelo produto escolhido
      $nova_qntd=$obj->quantidade-$qntd;
      $v_comprado=$obj->vezes_comprado+1;

      $sql_ordem = "INSERT INTO ordem_compra  (clientes_usuario_cod, usuarios_cod, data, lista_produtos) VALUES ('$cod_cliente','$cod_usuario','$data','$obj->nome')";
      $query_ordem=mysqli_query($conexao, $sql_ordem);

     $query_cli = $conexao->query("INSERT INTO vendas  (nome_cliente, email_cliente, telefone_cliente, cod_clientes_usuario, cod_produto, nome_produto, quantidade_produtos, preco, cod_usuario)
        VALUES ('$n_c','$email_c','$fone_c','$cod_cliente','$cod_prod','$obj->nome','$qntd','$preco','$cod_usuario')");
      $sql_baixa_estoque="UPDATE estoque_produtos
      SET estoque_produtos.quantidade = '$nova_qntd', estoque_produtos.vezes_comprado='$v_comprado'
      WHERE estoque_produtos.cod_produto ='$cod_prod'
      AND estoque_produtos.cod_usuario='$cod_usuario'";
      $query_estoque=mysqli_query($conexao, $sql_baixa_estoque);

    }
  }

}
echo "1 && nao";
}elseif ($acao=='sim') {
   $data=date('Y/m/d H:i');
 $total=0;

#Insere na tabela clientes os dados informados com o codigo do usuario q cadastrou
 $cod_usuario=$_SESSION['cod'];
#insere na trabela usuario as informações do cliente SE ele n existe E SE n dar o endereço
 /*sql = "INSERT INTO clientes_usuario (cod_usuario, nome, email, telefone, logradouro, numero_imovel, bairro, CEP, cidade, complemento, pais, estado)VALUES ('$cod_usuario','$n_c','$email_c','$fone_c','$logradouro_c','$num_imo','$bairro','$CEP','$cidade','$complemento','$pais','$estado')";
 $query=mysqli_query($conexao, $sql);*/
#pega o codigo do cliente q acabou de ser inserido
 $sql_cliente="SELECT cod_clientes FROM clientes_usuario WHERE cod_usuario ='$cod_usuario'";
 $query_cliente=mysqli_query($conexao, $sql_cliente);
 while ($line = $query_cliente->fetch_object()) {
  $cod_cliente=$line->cod_clientes;
}
#desmantela o SESSION do carrinho e faz as baixas devidas
foreach($_SESSION['cart'] as $cod_prod => $qntd) {
  $result = $conexao->query("SELECT * FROM estoque_produtos WHERE cod_produto ='$cod_prod' AND cod_usuario='$cod_usuario'");
  if($result){
    if($obj = $result->fetch_object()) {

      $preco = $obj->preco * $qntd;
      $total = $total + $preco;#determina o preço TOTAL pago pelo produto escolhido
      $nova_qntd=$obj->quantidade-$qntd;
      $v_comprado=$obj->vezes_comprado+1;

      $sql_ordem = "INSERT INTO ordem_compra  (clientes_usuario_cod, usuarios_cod, data, lista_produtos) VALUES ('$cod_cliente','$cod_usuario','$data','$obj->nome')";
      $query_ordem=mysqli_query($conexao, $sql_ordem);

      $query_vendas = $conexao->query("INSERT INTO vendas  (nome_cliente, email_cliente, telefone_cliente, cod_clientes_usuario, cod_produto, nome_produto, quantidade_produtos, preco, cod_usuario)
        VALUES ('$n_c','$email_c','$fone_c','$cod_cliente','$cod_prod','$obj->nome','$qntd','$preco','$cod_usuario')");
      $sql_baixa_estoque="UPDATE estoque_produtos
      SET estoque_produtos.quantidade = '$nova_qntd', estoque_produtos.vezes_comprado='$v_comprado'
      WHERE estoque_produtos.cod_produto ='$cod_prod'
      AND estoque_produtos.cod_usuario='$cod_usuario'";
      $query_estoque=mysqli_query($conexao, $sql_baixa_estoque);

    }
  }
}
}



unset($_SESSION['cart']);
unset($_SESSION['qntd_carrinho']);
unset($_SESSION['cod_cliente']);
header("Location: dashboard.php");
$conexao->close();

?>
