<?php
session_start();
require_once("conexion.php");

$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);

if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$user = getCurrentUser();
$string = file_get_contents('php://input'); 
$evento = json_decode($string, true);
$query = "INSERT INTO eventos (nombre,fecha,lugar,descripcion,idAdmin,foto) values (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ssssss',
	$evento["nombre"],
	$evento["fecha"],
	$evento["lugar"],
	$evento["descripcion"],
	$evento["idAdmin"],
	$evento["foto"]
	
);
$stmt->execute();
$res = $stmt->get_result();


$query = "INSERT INTO participantes (idFacebook,nombre,idEvento) values (?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'sss',
	$user["idFacebook"],
	$user["nombre"],
	$res
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>