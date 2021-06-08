<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'conexao.php';
?>

<!DOCTYPE html>
<html >
<body>
  <h1>Status de envio</h1>
  <span>relizado com sucesso!!!</span>
  <small>redirecionando...</small>
</body>
</html>
<?php
header("Refresh: 3; url=dashboard.php");
?>    
