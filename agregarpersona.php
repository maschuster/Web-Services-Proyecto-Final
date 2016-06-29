<?php

require_once("conexion.php");

$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);

if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$string = file_get_contents('php://input'); 
$objeto = json_decode($string, true);
$query = "INSERT INTO personas (idEvento, nombre) values (?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ss',
	$objeto["idEvento"],
	$objeto["nombre"]
	
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>