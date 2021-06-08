<?php
  include 'conexao.php'
 ?>
 <!doctype html>
 <html lang="en" class="h-100">
   <head>
     <meta charset="utf-8">
     <title>Stock Box</title>

     <link href="style/style.css" rel="stylesheet">
     <link href="style/cover.css" rel="stylesheet">
   </head>
   <body class="d-flex h-100 text-center text-white bg-dark">

 <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
   <header class="mb-auto">
     <div>
       <h3 class="float-md-start mb-0"><img src="images/logoinicio.png" alt=""width="100"></h3>
       <nav class="nav nav-masthead justify-content-center float-md-end">
         <a class="nav-link active" aria-current="page" href="#">Home</a>
         <a class="nav-link" href="signin.php">Entre</a>
         <a class="nav-link" href="signup.php">Cadastre-se</a>
       </nav>
     </div>
   </header>

   <main class="px-3">
     <h1>Stock box</h1>
     <p class="lead">Um Site feito para você que precisa de auxílio na hora de trabalhar com o estoque de seu pequeno negócio</p>

   </main>

   <footer class="mt-auto text-white-50">
     <p>Um projeto de <a href="" class="text-white">Estevão Ferreira</a></p>
   </footer>
 </div>



   </body>
 </html>
 <?php
  mysqli_close($conexao);
 ?>
