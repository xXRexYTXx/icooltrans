<?php 
session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
//conexion a la base de datos.
require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
	$records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();

	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';


//validacion si el resultado no está vacio
	if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
		$_SESSION['user_id'] = $results['id'];
		header("location: /php-login");
	}else{
		$message = 'Perdon, estas credenciales no coinciden';
	}

	
}

 ?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> | Login </title>
	<script src="https://kit.fontawesome.com/c33eb0491f.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body background="img/fondo.jpg">
	<?php 
require 'partials/header.php'
	 ?>



	<?php if (!empty($message)): ?>
<p><?= $message ?> </p>
	<?php endif ?>
		





	<form class="formulario" action="login.php" method="post">
		<h1>Iniciar Sesión <h3 style="margin-left: 55%; margin-top: -5%">o <a href="register2.php">Registrate</a></h3></h1>
		 
		<div class="contenedor">

			<div class="input-contenedor">
				<i class="fas fa-user icon"></i>
				<input name="email" type="text" placeholder="Nombre de Usuario" >
			</div>

			<div class="input-contenedor">
				<i class="fas fa-key icon"></i>
				<input name="password" type="password" placeholder="Contraseña">
			</div>
			<a><input type="submit" value="Iniciar Sesión"  class="botton"></a>
			<p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad</p>
		
		</div>
	</form>



	
</body>
</html>