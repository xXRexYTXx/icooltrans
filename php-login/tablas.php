<?php 
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
	$records  = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
	$records -> bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records ->fetch(PDO::FETCH_ASSOC);

	// se cimprueban los resultados, si son mayor a 0... significa que estan vacios
$user = null;

	if (count($results) > 0) {
			$user = $results;
			}
}
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tabla de Estadísticas</title>
	<link rel="stylesheet" href="assets/css/index.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	

</head>
<body background="img/fondo.jpg">


	<?php require 'partials/header.php'?>

	<?php if (!empty($user)): ?>


<header>
	<center>
		<br>
	<h1 style="color: white">Tabla de estadísticas</h1>
	<br>
	</center>
	</header>


 
	



		
	<nav class="navegacion">
		<a href="cargue.php">
			<button style=" margin-left:0.11%; width: 50%; height: 521px; border: none;  " type="button" class="btn btn-outline-dark">
				<div class="boton"><p style = "font-family:courier; font-size: 600%;  background-color: rgba(42,232,75,.5);">Cargue</p></div>
			 </button>
		</a>
		<a href="descargue.php">
			<button style="  width: 49.5%; height: 521px; border: none;  " type="button" class="btn btn-outline-dark">
				<div class="boton"><p style = "font-family:courier;  font-size: 600%; background-color: rgba(42,232,75,.5);">Descargue</p></div>
			</button>
		</a>
	</nav>
	




<?php else: ?>
	


	

		
	<?php endif; ?>
</body>
</html>