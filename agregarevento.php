<?php
require_once("conexion.php");
$con = getConnection();

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
if($res >0){
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
if($res >0){
	http_response_code(500);
	die("Error agregando Participante");
}

}else{
	http_response_code(500);
	die("Error agregando Evento");
}
mysqli_close($con);
?>