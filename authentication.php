<?php
	
require_once("conexion.php");
$con = getConnection();

$jsonToken = file_get_contents('php://input'); 
$token = json_decode($jsonToken, true);
$url = "https://graph.facebook.com/me?access_token=". $token["accesToken"];
$json = @file_get_contents($url);

if($json != false){
	
	$e = json_decode($json, true);
	$name = $e["name"];
	$id = $e["id"];
	$user = array('idFacebook'=> $id, 'nombre'=> $name);

	$query = 'SELECT * FROM usuarios WHERE idFacebook = ' . $user["idFacebook"];
	$resultado = mysqli_insert_id($con);
	if ($resultado > 1) {
			die("Ya creado");
	}else{
		$query = "INSERT INTO usuarios (idFacebook,nombre) values (?, ?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param(
			'ss',
			$user["idFacebook"],
			$user["nombre"]
		);
		$stmt->execute();
		$res = $stmt->get_result();
	}
	$res = json_encode($user,JSON_PRETTY_PRINT);
	echo $res;
}

mysqli_close($con);
?>