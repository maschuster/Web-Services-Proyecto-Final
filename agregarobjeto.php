<?php

require_once("conexion.php");
$con = getConnection();

$string = file_get_contents('php://input'); 
$objeto = json_decode($string, true);
$query = "INSERT INTO objetos (nombre,precio,idEvento, idParticipante, estado) values (?, ?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'sssss',
	$objeto["nombre"],
	$objeto["precio"],
	$objeto["idEvento"],
	$objeto["idParticipante"],
	$objeto["estado"]
	
);
$stmt->execute();
$stmt->get_result();
$resultado = mysqli_insert_id($con);
if($resultado < 1){
	http_response_code(500);
	die("Error agregando Objeto");
}

mysqli_close($con);

?>