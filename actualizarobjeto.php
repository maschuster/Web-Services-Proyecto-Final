<?php

require_once("conexion.php");
$con = getConnection();

$string = file_get_contents('php://input'); 
$objeto = json_decode($string, true);
$query = "UPDATE objetos SET estado = ? WHERE idObjeto = ?";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ss',
	$objeto["estado"],
	$objeto["idObjeto"]
);
$stmt->execute();
$res = $stmt->get_result();

mysqli_close($con);

?>