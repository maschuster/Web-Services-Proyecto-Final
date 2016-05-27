<?php
$con=mysqli_connect("localhost","root","","mydb");
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