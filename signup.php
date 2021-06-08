<?php
 session_start();
 include 'conexao.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Signin Template · Bootstrap v5.0</title>
  <link href="style/style.css" rel="stylesheet">
  <link href="style/signup.css" rel="stylesheet">
</head>
<body class="text-center">

  <main class="form-signin">

    <form action="validacao.php" method="POST" id="form" name="form" >
      <img class="mb-4" src="images/logoinicio.png" alt="" width="72" height="57">
        <div class="field">
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
        </div>

        <div class="field">
            <input type="text" id="telefone" name="telefone" placeholder="Digite seu Telefone" >
        </div>

        <div class="field">
            <input type="email" id="email" name="email" placeholder="Digite seu E-Mail"  required>
        </div>
        <div class="field">
          <input type="password" class="form-control" name="senha" id="floatingPassword" placeholder="Escolha sua senha" >
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button>
        <a href="index.php">Pagina inicial</a>
        <p class="mt-5 mb-3 text-muted">&copy;2021</p>
    </form>

  </main>



</body>
</html>
<?php
  $conexao->close();
 ?>
