<?php

require_once("conexion.php");

$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);

if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$string = file_get_contents('php://input'); 
$evento = json_decode($string, true);
$query = "INSERT INTO eventos (nombre,fecha,lugar,descripcion) values (?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ssss',
	$evento["nombre"],
	$evento["fecha"],
	$evento["lugar"],
	$evento["descripcion"]
	
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>