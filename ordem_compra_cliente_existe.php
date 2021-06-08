<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
if(!isset($_SESSION["usuario"])) {header("location:index.php");}
include 'conexao.php';
$cod_cliente=$_GET['cod_cliente'];
$_SESSION['cod_cliente']=$cod_cliente;

?>
<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Ordem de compra</title>
    <!-- Bootstrap core CSS -->
    <link href="style/style.css" rel="stylesheet">
    <link rel="import" href="images/cart-plus-solid.svg">

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
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Meu estoque
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="incluir.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                Inclu/alter/excluir
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ordem_compra.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                Abrir venda
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clientes_usuario.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Meus clientes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vendas.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                Vendas
              </a>
            </li>
          </ul>


        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Ordem de compra</h1>
        </div>
        <?php  
        $cod_usuario=$_SESSION['cod'];
        $sql="SELECT  * FROM estoque_produtos WHERE cod_usuario ='$cod_usuario' LIMIT 1";
        $tabela=mysqli_query($conexao, $sql);
        $row= mysqli_num_rows($tabela);
        if ($row == 1) {
         ?>
         <table align=center border=0 width=100%>
          <div id="navbarCollapse">
            <form class="d-flex" method="post" action="ordem_compra_search.php">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="parametro_pesquisa">
              <a class="btn btn-outline-success" type="submit" name="pesquisa_filtro" href="ordem_compra_search.php?acao=Pesquisa">Pesquisar</a>
              <a class="btn btn-outline-success" type="submit" name="limpa_filtro"  href="ordem_compra_search.php?acao=Limpa_pesquisa">Limpar filtros</a>
            </form>
          </div>
          <td><b>Nome do produto</b></td>
          <td><b>Preço</b></td>
          <td><b>Quantidade em estoque</b></td>
          <?php

          $cod_usuario=$_SESSION['cod'];
          //echo $_SESSION['cod'];
          $sql="SELECT * FROM estoque_produtos WHERE cod_usuario=".$cod_usuario;
          $tabela = mysqli_query($conexao,$sql);
          while ($linha = mysqli_fetch_array($tabela))
          {
            ?>
            <tr>

              <td>
                <?php echo $linha['nome']; ?>
                <hr>
              </td>
              <td>
                <?php echo $linha['preco']; ?>
                <hr>
              </td>
              <td>
                <?php echo $linha['quantidade']; ?>
                <hr>
              </td>
              <td width=80 align="center">
                <a href="inclui_carrinho.php?cod_cliente=<?php echo $cod_cliente ?>&acao=add_cliente_existe&cod=<?php echo $linha['cod_produto']; ?>">
                  <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" class="svg-inline--fa fa-cart-plus fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900 900"><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg>
                </a>
              </td>
              <?php  ?>
            </tr>
            <?php
          }

          ?>

        </table>
        <a class="btn btn-outline-success" href="finaliza_cart_existe.php?endereco=sim">Ordem de venda <strong>COM</strong> endereço de cliente</a>
        <a class="btn btn-outline-success" href="finaliza_cart_existe.php?endereco=nao">Ordem de venda <strong>SEM</strong> endereço de cliente</a>
      </div>

      <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="445" height="187" style="display: block; width: 445px; height: 187px;"></canvas>
    </main>
  </div>
</div>


<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>


</body>
</html>

<?php
}else {
  echo "Nenhum produto cadastrado <a  href='incluir.php'><strong>Cadastre</strong></a>  ";
}


?> 

</body>
</html>
