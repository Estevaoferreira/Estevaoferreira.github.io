<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'conexao.php';
$endereco=$_GET['endereco'];
$acao=$_GET['acao'];
$cod_prod=$_GET['cod'];
if ($acao === "limpar") {
  unset($_SESSION['cart']);
}

$result=$conexao->query("SELECT quantidade FROM estoque_produtos WHERE cod_produto=".$cod_prod);

if ($result) {
  if ($obj = $result->fetch_object()) {
    switch ($acao) {
      case 'add':
      if ($_SESSION['cart'][$cod_prod]+1 <= $obj->quantidade){
        $_SESSION['cart'][$cod_prod]++;
        $_SESSION['qntd_carrinho']+=1;
      }
      $_SESSION['endereco']=$endereco;
      header("location: ordem_compra.php");
      break;

      case 'remove':
      $_SESSION['cart'][$cod_prod]--;
      $_SESSION['qntd_carrinho']--;
      if ($_SESSION['cart'][$cod_prod]==0) {
        unset($_SESSION['cart'][$cod_prod]);
        $_SESSION['qntd_carrinho']=0;
      }
      $_SESSION['endereco']=$endereco;
      header("location: ordem_compra.php");
      break;
      case 'add_finaliza':
      if ($_SESSION['cart'][$cod_prod]+1 <= $obj->quantidade){
        $_SESSION['cart'][$cod_prod]++;
        $_SESSION['qntd_carrinho']+=1;
      }
      $_SESSION['endereco']=$endereco;
     header("location: finaliza_cart.php?endereco=$endereco");
      break;

      case 'remove_finaliza':
      $_SESSION['cart'][$cod_prod]--;
      $_SESSION['qntd_carrinho']--;
      if ($_SESSION['cart'][$cod_prod]==0) {
        unset($_SESSION['cart'][$cod_prod]);
      //  $_SESSION['qntd_carrinho']=0;
      }
      $_SESSION['endereco']=$endereco;
      header("location: finaliza_cart.php?endereco=$endereco");
      break;
      case 'add_finaliza_endereco':
      if ($_SESSION['cart'][$cod_prod]+1 <= $obj->quantidade){
        $_SESSION['cart'][$cod_prod]++;
        $_SESSION['qntd_carrinho']+=1;
      }
      $_SESSION['endereco']=$endereco;
      header("location: finaliza_cart.php?endereco=$endereco");
      break;
      case 'remove_finaliza_endereco':
      $_SESSION['cart'][$cod_prod]--;
      $_SESSION['qntd_carrinho']--;
      if ($_SESSION['cart'][$cod_prod]==0) {
        unset($_SESSION['cart'][$cod_prod]);
      //  $_SESSION['qntd_carrinho']=0;
      }
      $_SESSION['endereco']=$endereco;
      header("location: finaliza_cart.php?endereco=$endereco");
      break;

      case 'add_cliente_existe':
      if ($_SESSION['cart'][$cod_prod]+1 <= $obj->quantidade){
        $_SESSION['cart'][$cod_prod]++;
        $_SESSION['qntd_carrinho']+=1;
      }
      $cod_cliente=$_GET['cod_cliente'];
      header("location: ordem_compra_cliente_existe.php?cod_cliente=$cod_cliente");
      break;
    }
  }
}
?>
