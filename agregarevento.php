<?php
require_once("conexion.php");
$con = getConnection();

$user = getCurrentUser();
$string = file_get_contents('php://input'); 
$evento = json_decode($string, true);
$query = "INSERT INTO eventos (idAdmin,nombre,fecha,lugar,descripcion,foto) values (?, ?, ?, ?, ?, ?)";
echo $evento["foto"];
$foto = base64_decode($evento["foto"]);
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ssssss',
	$evento["idAdmin"],
	$evento["nombre"],
	$evento["fecha"],
	$evento["lugar"],
	$evento["descripcion"],
	$foto
);
$stmt->execute();
$stmt->get_result();
$res = mysqli_insert_id($con);
if($res>1)
{
	$query = "INSERT INTO participantes (idFacebook,nombre,idEvento) values (?, ?, ?)";
	$stmt = $con->prepare($query);
	$stmt->bind_param(
		'sss',
		$user["idFacebook"],
		$user["nombre"],
		$res
	);
	$stmt->execute();
	$stmt->get_result();
	$resultado = mysqli_insert_id($con);
	
	if($resultado < 1){
		http_response_code(500);
		die("Error agregando Participante");
		json(array("Error" => "NO"));
	}else{
		json(array("Mensaje" => "OK"));
	}
}
else
{
	http_response_code(500);
	die("Error agregando Evento");
	json(array("Error" => "NO"));
}


function json($param) {
	header("Content-Type: application/json; charset=UTF-8");
	$json = json_encode($param, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	echo($json);
	echo("\n");
}

mysqli_close($con);
?>