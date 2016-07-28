<?php
session_start();
require_once("conexion.php");
$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);
if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$jsonToken = file_get_contents('php://input'); 
$token = json_decode($jsonToken, true);
$url = "https://graph.facebook.com/me?access_token=". $token["accesToken"];
//$url = "https://graph.facebook.com/me?access_token=EAAXiLB7hBPwBAAZBTEJCXfP17iAEY2IfcBZA5GZCxZByPpNdUbwGb0BfQZCLoQxCoTEOKdF9TShoKig2WZAuzpvi4ZC0DxY2cP5dk0o9VPUU0y5n0rTXlZB79JY6J9CzFacST1RJx4clVk9jmS2og53AwTJbjYjZCv5wCAWJPsQOGCAGOYPHVAxOe9IPFz2AAklIZD";
$json = @file_get_contents($url);

if($json != false){
    $e = json_decode($json, true);
	$name = $e["name"];
    $id = $e["id"];
	$user = array('idFacebook'=> $id, 'nombre'=> $name);
	
	$query = 'SELECT * FROM usuarios WHERE idFacebook =' . $user["idFacebook"];
	$result = mysqli_query($con, $query);
	if ($result == false) 		
	{
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
	
	$_SESSION['userID']= $user["idFacebook"];
	$jsonstring = json_encode($user,JSON_PRETTY_PRINT);
	echo $jsonstring;
}
else
{
    $response = "0";
	$jsonstring = json_encode($response,JSON_PRETTY_PRINT);
	echo $jsonstring;
}
mysqli_close($con);
?>