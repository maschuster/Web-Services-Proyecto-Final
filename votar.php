<?php

require_once("conexion.php");
$con = getConnection();

$string = file_get_contents('php://input'); 
$respuesta = json_decode($string, true);
$query = "INSERT INTO respuestas (idParticipante, idPregunta, voto) values (?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'sss',
	$respuesta["idParticipante"],
	$respuesta["idPregunta"],
	$respuesta["voto"]
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);
?>