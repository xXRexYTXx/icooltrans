<!-- requerir la conexion de base de datos.-->
<?php 
require 'database.php';

//variable global de mensaje
$message = ""; 


//redirigir los datos del formulario sigUp hacia nuestra base de datos (si los campos no estan vacios)

if (!empty($_POST['email'])&& !empty($_POST['password'])) {
	$sql= "INSERT INTO users (email, password) values (:email, :password)";
	$stmt = $conn->prepare($sql);

	$stmt ->bindParam(':email', $_POST['email']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$stmt ->bindParam(':password', $password);

	if ( $stmt -> execute()) {
	$message = "<center><h3>Tu Usuario Ha Sido Creado Satisfactoriamente.</h3></center>";
}
else{

	$message = "Perdón, Ha Ocurrido Un Error Creando Su Contraseña.";
	}
}


 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<meta charset="UTF-8">
	<title>| Regístrate </title>
	      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://kit.fontawesome.com/c33eb0491f.js"></script>
</head>
<body background="img/fondo.jpg">
	<?php 
require 'partials/header.php'
	 ?>


 <?php 
//condicional error mediante mensaje
if (!empty($message)): ?>
	<p><?= $message ?></p>
	<?php endif; ?>



	<form class="formulario" action="register2.php" method="post">
		<h1>Regístrate</h1>
		<div class="contenedor">
			
<!-- requerir datos del usuario para hacer su respectivo signUp-->
			<div class="input-contenedor">
				<i class="fas fa-user icon"></i>
				<input type="text" name="email" placeholder="Nombre de Usuario" required="">
			</div>

			<div class="input-contenedor">
				<i class="fas fa-key icon"></i>
				<input type="password" name="password" placeholder="Contraseña" required="">
			</div>
			<div class="input-contenedor">
				<i class="fas fa-key icon"></i>
				<input type="password" name="confirm_password" placeholder="Confirmar Contraseña" >
			</div>
			<input type="submit" value="Regístrate"  class="botton">
			<p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad</p>
			<p>¿Ya tienes cuenta? <a class="link" href="login.php">Iniciar Sesión</a> </p>
		</div>
	</form>
</body>

</html>