<?php
	
require_once("conexion.php");
$con=mysqli_connect($GLOBALS["MYSQL_HOSTNAME"], $GLOBALS["MYSQL_USERNAME"], $GLOBALS["MYSQL_PASSWORD"], $GLOBALS["MYSQL_DATABASE"]);
if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$jsonToken = file_get_contents('php://input'); 
$token = json_decode($jsonToken, true);
$url = "https://graph.facebook.com/me?access_token=". $token["accesToken"];
$json = @file_get_contents($url);

if($json == false)
	die("Invalido");

$e = json_decode($json, true);
$name = $e["name"];
$id = $e["id"];
$user = array('idFacebook'=> $id, 'nombre'=> $name);

$query = 'SELECT * FROM usuarios WHERE idFacebook = ' . $user["idFacebook"];
$result = mysqli_query($con, $query);
if ($result == false) {
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

$_SESSION["USER_ID"] = $user["idFacebook"];

$res = json_encode($user,JSON_PRETTY_PRINT);
echo $res;

mysqli_close($con);
?>