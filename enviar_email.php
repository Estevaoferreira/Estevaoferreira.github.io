<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
if(!isset($_SESSION["usuario"])) {header("location:index.php");}
include 'conexao.php';
$cod_venda=$_GET['cod_venda'];
$nome_usuario=$_SESSION['nome'];
$sql="SELECT * FROM vendas WHERE cod_venda=".$cod_venda;
$tabela=mysqli_query($conexao, $sql);
while ($linha = $tabela->fetch_object())
{
  $nome_cliente=$linha->nome_cliente;
  $email_cliente=$linha->email_cliente;
  $telefone_cliente=$linha->telefone_cliente;
  $cod_cliente=$linha->cod_clientes_usuario;
  $cod_produto=$linha->cod_produto;
  $nome_produto=$linha->nome_produto;
  $qntd_produto=$linha->quantidade_produtos;
  $preco_produto=$linha->preco;
  $cod_usuario=$linha->cod_usuario;
}
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'estevao.ferreira.programador@gmail.com';
  $mail->Password = '@ju110177';
  $mail->Port = 587;

  $mail->setFrom('estevao.ferreira.programador@gmail.com');
  $mail->addAddress($email_cliente);

  $mail->isHTML(true);
  $mail->Subject = 'Ordem de compra de '.$nome_cliente.' confirmada';
  $mail->Body = '<strong>'.$nome_cliente.'</strong> você comprou <strong>'.$qntd_produto.'</strong> unidade(s) de <strong>'.$nome_produto.'</strong> por um valor de <strong>R$'.$preco_produto.'</strong> Agradecemos de coração sua preferência por comprar conosco, eu ,'.$nome_usuario.', fico muito grato pela sua escolha. Logo você receberá seus produtos';
  $mail->AltBody = 'Agradecemos de coração sua preferência por comprar conosco, eu ,'.$nome_usuario.', fico muito grato pela sua escolha. Logo você receberá seus produtos';

if($mail->send()) {
    echo 'Email enviado com sucesso';
  } else {
    echo 'Email nao enviado';
  }
} catch (Exception $e) {
  echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}

?>
<meta http-equiv="refresh" content="0;url=envio_confirmado.php">
