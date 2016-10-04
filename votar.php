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

if($respuesta["voto"] == 1){
	$query = "UPDATE preguntas SET afirmativos = afirmativos+1 WHERE idPregunta = ?";
}else{
	$query = "UPDATE preguntas SET negativos = negativos+1 WHERE idPregunta = ?";
}

$stmt = $con->prepare($query);
$stmt->bind_param(
	's',
	$respuesta["idPregunta"]
);
$stmt->execute();
$res = $stmt->get_result();
mysqli_close($con);
?>