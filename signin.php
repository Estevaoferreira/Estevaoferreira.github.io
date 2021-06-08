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
  <link href="style/signin.css" rel="stylesheet">
</head>
<body class="text-center">

  <main class="form-signin">
    <form action="validalogin.php" method="POST" id="form" name="form">
      <img class="mb-4" src="images/logoinicio.png" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="senha" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">senha</label>
      </div>


      <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
      <a href="index.php">Pagina inicial</a>
      <p class="mt-5 mb-3 text-muted">&copy;2021</p>
    </form>
  </main>



</body>
</html>
<?php
  $conexao->close();
 ?>
