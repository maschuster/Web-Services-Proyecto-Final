<?php

require_once("conexion.php");
$con = getConnection();

$string = file_get_contents('php://input'); 
$participante = json_decode($string, true);
$query = "INSERT INTO participantes (idEvento, idFacebook, nombre) values (?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'sss',
	$participante["idEvento"],
	$participante["idFacebook"],
	$participante["nombre"]
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>