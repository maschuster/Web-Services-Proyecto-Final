<?php
$con=mysqli_connect("localhost","root","","mydb");
if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$string = file_get_contents('php://input'); 
$objeto = json_decode($string, true);
$query = "INSERT INTO objetos (nombre,precio,idEvento, idUsuario) values (?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ssss',
	$objeto["nombre"],
	$objeto["precio"],
	$objeto["idEvento"],
	$objeto["idUsuario"]
	
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>