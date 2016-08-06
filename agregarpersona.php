<?php

require_once("conexion.php");
$con = getConnection();

$string = file_get_contents('php://input'); 
$persona = json_decode($string, true);
$query = "INSERT INTO personas (idEvento, nombre) values (?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ss',
	$persona["idEvento"],
	$persona["nombre"]
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>