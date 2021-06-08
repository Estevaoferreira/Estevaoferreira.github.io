<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'conexao.php';
$acao=$_GET['acao'];
$cod_prod=$_GET['cod'];
$cod_usuario=$_SESSION['cod'];

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Incluir no estoque</title>

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
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="logo_top" >
      <!--<img src="images/logoinicio.png" >-->
    </div>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Adicionar ao estoque</h1>
        </div>
        <?php
        if(isset($_SESSION['erroCampoNome'])) {
          echo "<script>alert('TODOS os campos devem ser preenchidos');</script>";
        }else {
          $_SESSION['erroCampoNome']="";
        }
        $sql="SELECT * FROM estoque_produtos WHERE cod_produto=".$cod_prod;
        $tabela = mysqli_query($conexao,$sql);
        while ($linha = mysqli_fetch_array($tabela))
        {
        ?>
        <form name="dados" method="post" action="altera_estoque.php?acao=<?php echo $acao; ?>&cod=<?php echo $cod_prod; ?>">
          <p>
            <div class="form-floating">
              <p>Nome:<input type="text" class="form-control" id="floatingInput" name="nome" value="<?php echo $linha['nome'] ?>"></p>
            </div>
          </p>
          <p>
            <div class="form-floating">
              <p>Preço: <input type="text" class="form-control" id="floatingInput" name="preco" value="<?php echo $linha['preco']; ?>"></p>
            </div>
          </p>
          <p>
            <div class="form-floating">
              <p>Quantidade: <input type="number" class="form-control"  id="floatingInput" name="quantidade" value="<?php echo $linha['quantidade']; ?>" ></p>
            </div>
          </p>
          <p>
            <input class="w-100 btn btn-lg btn-primary" type="submit" name="acao" value="<?php echo $acao; ?>" >
            <a class="w-100 btn btn-lg btn-primary" href="dashboard.php">Cancelar</a>
          </p>
        </form>
      </body>
      </html>
      <?php
    }
      mysqli_close($conexao);
      ?>

    </div>

    <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="445" height="187" style="display: block; width: 445px; height: 187px;"></canvas>
  </main>
</div>
</div>




</body>
</html>
