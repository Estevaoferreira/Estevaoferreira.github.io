<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
if(!isset($_SESSION["usuario"])) {header("location:index.php");}
include 'conexao.php';
if(!isset($_SESSION["qntd_carrinho"])) {header("location:ordem_compra.php");}
$qntd_carrinho=$_SESSION['qntd_carrinho'];
if ($qntd_carrinho==0) {header("location:ordem_compra_cliente_existe.php");}
$endereco=$_GET['endereco'];

if ($endereco=='nao') {
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
        <div class="col-md-5 col-lg-4 order-md-last">

          <table class="list-group mb-3">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Carrinho</span>
              <span class="badge bg-primary rounded-pill"><?php echo $_SESSION['qntd_carrinho']; ?></span>
            </h4>
            <?php
            if(isset($_SESSION['cart'])) {

              $total = 0;

              foreach($_SESSION['cart'] as $cod_prod => $qntd) {
                $cod_usuario=$_SESSION['cod'];
                $result = $conexao->query("SELECT * FROM estoque_produtos
                  WHERE cod_produto ='$cod_prod' AND cod_usuario='$cod_usuario'");


                  if($result){

                    while($obj = $result->fetch_object()) {
                      $preco = $obj->preco * $qntd; //work out the line cost
                      $total = $total + $preco; //add to the total cost
                      // Fazendo uma consulta SQL
                      //$sql = "SELECT * FROM estoque_produtos ORDER BY nome";

                      //echo $_SESSION['cod'];

                      ?>
                      <tr>
                        <td class="list-group-item d-flex justify-content-between ">
                          <div>
                            <h6 class="my-0"><?php echo $obj->nome; ?></h6>
                          </div>
                          <span class="text-muted">R$<?php echo $obj->preco; ?></span>
                          <p>X<span class="text-muted"><?php echo $qntd; ?></span></p>
                          <a href="inclui_carrinho.php?endereco=<?php echo $endereco ?>&acao=remove_finaliza&cod=<?php echo $cod_prod; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                              <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                            </svg>
                          </a>
                          <a href="inclui_carrinho.php?endereco=<?php echo $endereco ?>&acao=add_finaliza&cod=<?php echo $cod_prod; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                              <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                            </svg>
                          </a>
                        </td>

                      </tr>

                    </div>
                    <?php
                  }
                }
              }
            }
            ?>
            <td class="list-group-item d-flex justify-content-between">
              <span>Total R$</span>
              <strong><?php echo $total; ?></strong>
            </td>
          </table>
          <a class="btn btn-outline-success" href="ordem_compra.php">Voltar</a>
        </div>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Informações do seu cliente</h4>


          <form class="needs-validation"  action="finaliza_ordem_existe.php?endereco=nao" method="post">
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Nome do cliente</label>
                <input type="text" class="form-control" id="nomeCliente" required name="nome_cliente">
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email do cliente</label>
                <input type="email" class="form-control" required id="email" placeholder="you@example.com" name="email_cliente">
              </div>
              <div class="col-12">
                <label for="address2" class="form-label">Número de contato</label>
                <input type="text" class="form-control" required id="address2" placeholder="+55(DDD)999999999" name="numero_contato_cliente">
              </div>

            </div>
            <hr>

            <button class="w-100 btn btn-primary btn-lg" type="submit" >Finalizar ordem</button>
          </form>
        </div>
      </div>
    </main>

  </div>
</div>
</body>
</html>

<?php
}else {
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
        <div class="col-md-5 col-lg-4 order-md-last">

          <table class="list-group mb-3">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Carrinho</span>
              <span class="badge bg-primary rounded-pill"><?php echo $_SESSION['qntd_carrinho']; ?></span>
            </h4>
            <?php
            if(isset($_SESSION['cart'])) {

              $total = 0;

              foreach($_SESSION['cart'] as $cod_prod => $qntd) {
                $cod_usuario=$_SESSION['cod'];
                $result = $conexao->query("SELECT * FROM estoque_produtos
                  WHERE cod_produto ='$cod_prod' AND cod_usuario='$cod_usuario'");


                if($result){

                  while($obj = $result->fetch_object()) {
                      $preco = $obj->preco * $qntd; //work out the line cost
                      $total = $total + $preco; //add to the total cost
                      // Fazendo uma consulta SQL
                      //$sql = "SELECT * FROM estoque_produtos ORDER BY nome";

                      //echo $_SESSION['cod'];

                      ?>
                      <tr>
                        <td class="list-group-item d-flex justify-content-between ">
                          <div>
                            <h6 class="my-0"><?php echo $obj->nome; ?></h6>
                          </div>
                          <span class="text-muted">R$<?php echo $obj->preco; ?></span>
                          <p>X<span class="text-muted"><?php echo $qntd; ?></span></p>
                          <a href="inclui_carrinho.php?endereco=<?php echo $endereco ?>&acao=remove_finaliza_endereco&cod=<?php echo $cod_prod; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                              <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                            </svg>
                          </a>
                          <a href="inclui_carrinho.php?endereco=<?php echo $endereco ?>&acao=add_finaliza_endereco&cod=<?php echo $cod_prod; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                              <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                            </svg>
                          </a>
                        </td>

                      </tr>

                    </div>
                    <?php
                  }
                }
              }
            }
            ?>
            <td class="list-group-item d-flex justify-content-between">
              <span>Total R$</span>
              <strong><?php echo $total; ?></strong>
            </td>
          </table>
          <a class="btn btn-outline-success" href="ordem_compra.php">Voltar</a>
        </div>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Informações do seu cliente</h4>


          <form class="needs-validation"  action="finaliza_ordem_existe.php?endereco=sim" method="post">
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Nome do cliente</label>
                <input type="text" class="form-control" id="nomeCliente" required name="nome_cliente">
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email do cliente</label>
                <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email_cliente">
              </div>
              <div class="col-12">
                <label for="address2" class="form-label">Número de contato</label>
                <input type="text" class="form-control" id="address2" placeholder="+55(DDD)999999999" required name="numero_contato_cliente">
              </div>
              <div class="col-12">
                <label for="address" class="form-label">Logradouro</label>
                <input type="text" class="form-control" required id="address" placeholder="Rua...avenida..."  name="logradouro_cliente">
              </div>

              <div class="col-12">
                <label for="address2" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="address2" required placeholder="Casa ou AP" name="complemento">
              </div>
              <div class="col-12">
                <label for="address2" class="form-label">Número residencial</label>
                <input type="number" class="form-control" id="address2" required placeholder="..." name="numero_imovel_cliente">
              </div>

              <div class="col-md-5">
                <label for="country" class="form-label">País</label>
                <select class="form-select" id="country" required name="pais_cliente">
                  <option value="nenhum" selected>-</option>
                  <option value="África do Sul">África do Sul</option>
                  <option value="Albânia">Albânia</option>
                  <option value="Alemanha">Alemanha</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antigua">Antigua</option>
                  <option value="Arábia Saudita">Arábia Saudita</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armênia">Armênia</option>
                  <option value="Aruba">Aruba</option>
                  <option value="Austrália">Austrália</option>
                  <option value="Áustria">Áustria</option>
                  <option value="Azerbaijão">Azerbaijão</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrein">Bahrein</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Bélgica">Bélgica</option>
                  <option value="Benin">Benin</option>
                  <option value="Bermudas">Bermudas</option>
                  <option value="Botsuana">Botsuana</option>
                  <option value="Brasil" >Brasil</option>
                  <option value="Brunei">Brunei</option>
                  <option value="Bulgária">Bulgária</option>
                  <option value="Burkina Fasso">Burkina Fasso</option>
                  <option value="botão">botão</option>
                  <option value="Cabo Verde">Cabo Verde</option>
                  <option value="Camarões">Camarões</option>
                  <option value="Camboja">Camboja</option>
                  <option value="Canadá">Canadá</option>
                  <option value="Cazaquistão">Cazaquistão</option>
                  <option value="Chade">Chade</option>
                  <option value="Chile">Chile</option>
                  <option value="China">China</option>
                  <option value="Cidade do Vaticano">Cidade do Vaticano</option>
                  <option value="Colômbia">Colômbia</option>
                  <option value="Congo">Congo</option>
                  <option value="Coréia do Sul">Coréia do Sul</option>
                  <option value="Costa do Marfim">Costa do Marfim</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Croácia">Croácia</option>
                  <option value="Dinamarca">Dinamarca</option>
                  <option value="Djibuti">Djibuti</option>
                  <option value="Dominica">Dominica</option>
                  <option value="EUA">EUA</option>
                  <option value="Egito">Egito</option>
                  <option value="El Salvador">El Salvador</option>
                  <option value="Emirados Árabes">Emirados Árabes</option>
                  <option value="Equador">Equador</option>
                  <option value="Eritréia">Eritréia</option>
                  <option value="Escócia">Escócia</option>
                  <option value="Eslováquia">Eslováquia</option>
                  <option value="Eslovênia">Eslovênia</option>
                  <option value="Espanha">Espanha</option>
                  <option value="Estônia">Estônia</option>
                  <option value="Etiópia">Etiópia</option>
                  <option value="Fiji">Fiji</option>
                  <option value="Filipinas">Filipinas</option>
                  <option value="Finlândia">Finlândia</option>
                  <option value="França">França</option>
                  <option value="Gabão">Gabão</option>
                  <option value="Gâmbia">Gâmbia</option>
                  <option value="Gana">Gana</option>
                  <option value="Geórgia">Geórgia</option>
                  <option value="Gibraltar">Gibraltar</option>
                  <option value="Granada">Granada</option>
                  <option value="Grécia">Grécia</option>
                  <option value="Guadalupe">Guadalupe</option>
                  <option value="Guam">Guam</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Guiana">Guiana</option>
                  <option value="Guiana Francesa">Guiana Francesa</option>
                  <option value="Guiné-bissau">Guiné-bissau</option>
                  <option value="Haiti">Haiti</option>
                  <option value="Holanda">Holanda</option>
                  <option value="Honduras">Honduras</option>
                  <option value="Hong Kong">Hong Kong</option>
                  <option value="Hungria">Hungria</option>
                  <option value="Iêmen">Iêmen</option>
                  <option value="Ilhas Cayman">Ilhas Cayman</option>
                  <option value="Ilhas Cook">Ilhas Cook</option>
                  <option value="Ilhas Curaçao">Ilhas Curaçao</option>
                  <option value="Ilhas Marshall">Ilhas Marshall</option>
                  <option value="Ilhas Turks & Caicos">Ilhas Turks & Caicos</option>
                  <option value="Ilhas Virgens (brit.)">Ilhas Virgens (brit.)</option>
                  <option value="Ilhas Virgens(amer.)">Ilhas Virgens(amer.)</option>
                  <option value="Ilhas Wallis e Futuna">Ilhas Wallis e Futuna</option>
                  <option value="Índia">Índia</option>
                  <option value="Indonésia">Indonésia</option>
                  <option value="Inglaterra">Inglaterra</option>
                  <option value="Irlanda">Irlanda</option>
                  <option value="Islândia">Islândia</option>
                  <option value="Israel">Israel</option>
                  <option value="Itália">Itália</option>
                  <option value="Jamaica">Jamaica</option>
                  <option value="Japão">Japão</option>
                  <option value="Jordânia">Jordânia</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Latvia">Latvia</option>
                  <option value="Líbano">Líbano</option>
                  <option value="Liechtenstein">Liechtenstein</option>
                  <option value="Lituânia">Lituânia</option>
                  <option value="Luxemburgo">Luxemburgo</option>
                  <option value="Macau">Macau</option>
                  <option value="Macedônia">Macedônia</option>
                  <option value="Madagascar">Madagascar</option>
                  <option value="Malásia">Malásia</option>
                  <option value="Malaui">Malaui</option>
                  <option value="Mali">Mali</option>
                  <option value="Malta">Malta</option>
                  <option value="Marrocos">Marrocos</option>
                  <option value="Martinica">Martinica</option>
                  <option value="Mauritânia">Mauritânia</option>
                  <option value="Mauritius">Mauritius</option>
                  <option value="México">México</option>
                  <option value="Moldova">Moldova</option>
                  <option value="Mônaco">Mônaco</option>
                  <option value="Montserrat">Montserrat</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Nicarágua">Nicarágua</option>
                  <option value="Niger">Niger</option>
                  <option value="Nigéria">Nigéria</option>
                  <option value="Noruega">Noruega</option>
                  <option value="Nova Caledônia">Nova Caledônia</option>
                  <option value="Nova Zelândia">Nova Zelândia</option>
                  <option value="Omã">Omã</option>
                  <option value="Palau">Palau</option>
                  <option value="Panamá">Panamá</option>
                  <option value="Papua-nova Guiné">Papua-nova Guiné</option>
                  <option value="Paquistão">Paquistão</option>
                  <option value="Peru">Peru</option>
                  <option value="Polinésia Francesa">Polinésia Francesa</option>
                  <option value="Polônia">Polônia</option>
                  <option value="Porto Rico">Porto Rico</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Quênia">Quênia</option>
                  <option value="Rep. Dominicana">Rep. Dominicana</option>
                  <option value="Rep. Tcheca">Rep. Tcheca</option>
                  <option value="Reunion">Reunion</option>
                  <option value="Romênia">Romênia</option>
                  <option value="Ruanda">Ruanda</option>
                  <option value="Rússia">Rússia</option>
                  <option value="Saipan">Saipan</option>
                  <option value="Samoa Americana">Samoa Americana</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Serra Leone">Serra Leone</option>
                  <option value="Seychelles">Seychelles</option>
                  <option value="Singapura">Singapura</option>
                  <option value="Síria">Síria</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="St. Kitts & Nevis">St. Kitts & Nevis</option>
                  <option value="St. Lúcia">St. Lúcia</option>
                  <option value="St. Vincent">St. Vincent</option>
                  <option value="Sudão">Sudão</option>
                  <option value="Suécia">Suécia</option>
                  <option value="Suiça">Suiça</option>
                  <option value="Suriname">Suriname</option>
                  <option value="Tailândia">Tailândia</option>
                  <option value="Taiwan">Taiwan</option>
                  <option value="Tanzânia">Tanzânia</option>
                  <option value="Togo">Togo</option>
                  <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                  <option value="Tunísia">Tunísia</option>
                  <option value="Turquia">Turquia</option>
                  <option value="Ucrânia">Ucrânia</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Uruguai">Uruguai</option>
                  <option value="Venezuela">Venezuela</option>
                  <option value="Vietnã">Vietnã</option>
                  <option value="Zaire">Zaire</option>
                  <option value="Zâmbia">Zâmbia</option>
                  <option value="Zimbábue">Zimbábue</option>
                </select>
              </div>

              <div class="col-md-4">
                <label for="state" class="form-label">Estado</label>
                <select class="form-select" id="state" required name="estado_cliente">
                  <option value="nenhum" selected>-</option>
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                </select>
              </div>
              <div class="col-12">
                <label for="address2" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="address2" required placeholder="..." name="cidade_cliente">
              </div>
              <div class="col-12">
                <label for="address2" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="address2" required placeholder="..."name="bairro_cliente">
              </div>
              <div class="col-md-3">
                <label for="zip" class="form-label">CEP</label>
                <input type="number" class="form-control" id="zip" required placeholder=""  name="cep_cli">
              </div>
            </div>
            <hr>

            <button class="w-100 btn btn-primary btn-lg" type="submit">Finalizar ordem</button>
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
?>
