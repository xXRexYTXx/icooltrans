<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Icoltrans</title>
     <link rel="stylesheet" href="assets/css/index.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   
  </head>
  <body background="img/fondo.jpg">
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br>
      <header>
        <center>
      <h1 style="color: white; margin-top: -2%"> Bienvenido. <?= $user['email']; ?></h1>
      <h1 style="color: white">tu estas logeado</h1>
      </center>
      </header>
  <a href="tablas.php">Llenar datos</a>
  <br>

      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <header>
        <center>
      <h1 style="color: white">Por favor inicia sesión o Regístrate</h1>
      </center>
      </header>
      <a href="login.php"><button style="  width: 49%; height: 521px; border: none;  " type="button" class="btn btn-outline-dark">
        <div class="boton"><p style = "font-family:courier; font-size: 600%;  background-color: rgba(42,232,75,.5);">Logearme</p></div>
       </button>
    </a>
       

     <a href="register2.php"><button style="  width: 49%; height: 521px; border: none;  " type="button" class="btn btn-outline-dark">
        <div class="boton"><p style = "font-family:courier;  font-size: 600%; background-color: rgba(42,232,75,.5);">Registrarse</p></div>
      </button></a>
    <?php endif; ?>
  </body>
</html>
