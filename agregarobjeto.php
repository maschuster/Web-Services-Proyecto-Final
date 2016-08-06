<?php

require_once("conexion.php");
$con = getConnection();

$string = file_get_contents('php://input'); 
$objeto = json_decode($string, true);
$query = "INSERT INTO objetos (nombre,precio,idEvento, idUsuario, estado) values (?, ?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'sssss',
	$objeto["nombre"],
	$objeto["precio"],
	$objeto["idEvento"],
	$objeto["idUsuario"],
	$objeto["estado"]
	
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>