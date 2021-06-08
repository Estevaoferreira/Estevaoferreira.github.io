<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
if(!isset($_SESSION["usuario"])) {header("location:index.php");}
include 'conexao.php';
$acao=$_GET['endereco'];
$cod_usuario=$_SESSION['cod'];
$email = mysqli_real_escape_string($conexao, trim($_POST['email_cliente']));

$query = "SELECT * FROM clientes_usuario WHERE email='$email' AND cod_usuario=".$cod_usuario;

$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);
if ($row == 1 && $acao=='nao') {
  while ($obj=$result->fetch_object()) {
    $n_c=$obj->nome;
    $email_c=$obj->email;
    $fone_c=$obj->telefone;
  }
  ?>
  <!doctype html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.82.0">
      <title>Carrinho</title>
      <!-- Bootstrap core CSS -->
      <link href="style/style.css" rel="stylesheet">

      <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <style type="text/css">/* Chart.js */
    @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
  </style>
</head>
<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php   echo ($_SESSION['nome']);?></a>

    <div class="logo_top" >
      <img src="images/logoinicio.png" >
    </div>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </header>
  <div class="container">
    <main class="col-md-9">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ordem de pedido</h1>
      </div>
      <div class="row g-5">
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Informações do seu cliente</h4>


          <form class="needs-validation"  action="confirma_ordem_existe.php?endereco=nao" method="post">
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Nome do cliente</label>
                <input type="text" class="form-control" name="nome_cliente"  value="<?php echo $n_c; ?>">
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email do cliente</label>
                <input type="email" class="form-control" name="email_cliente" placeholder="you@example.com" value="<?php echo $email_c; ?>">
              </div>
              <div class="col-12">
                <label for="address2" class="form-label">Número de contato</label>
                <input type="text" class="form-control" name="numero_contato_cliente" placeholder="55(DDD)999999999" value="<?php echo $fone_c; ?>">
              </div>

            </div>
            <hr>

            <button class="w-100 btn btn-primary btn-lg" type="submit" >Concluir</button>
          </form>
        </div>
      </div>
    </main>

  </div>
</div>
</body>
</html>
<?php
}

///////////////////////////////////////////////////////
elseif ($row == 1 && $acao=='sim') {
  while ($obj=$result->fetch_object()) {
    $n_c=$obj->nome;
    $email_c=$obj->email;
    $fone_c=$obj->telefone;
    $logradouro_c=$obj->logradouro;
    $num_imo=$obj->numero_imovel;
    $bairro=$obj->bairro;
    $CEP=$obj->CEP;
    $cidade=$obj->cidade;
    $complemento=$obj->complemento;
    $pais=$obj->pais;
    $estado=$obj->estado;
  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <title>Finaliza ordem</title>
  </head>
  <body>
    <h1>ROW==1 && ACAO==sim</h1>
  </body>
  </html>
  <?php
}