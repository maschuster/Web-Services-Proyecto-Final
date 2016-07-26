<?php
session_start();
require_once("conexion.php");
$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);
if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$string = file_get_contents('php://input'); 
$token = json_decode($string, true);
$url = "https://graph.facebook.com/me?access_token=". $token;
$json = @file_get_contents($url);

if($json != false){
    $e = json_decode($json, true);
		
	$name = $e["name"];
    $id = $e["id"];
	$user = array('idFacebook'=> $id, 'name'=> $name);
	
	$query = 'SELECT * FROM usuarios WHERE idFacebook =' . $id;
	$result = mysqli_query($con, $query);
	if (mysql_num_rows($result)==0) 
	{
		$query = "INSERT INTO usuarios (idFacebook,nombre) values (?, ?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param(
			'ss',
			$user["idFacebook"],
			$user["name"]
		);
		$stmt->execute();
		$res = $stmt->get_result();
	}
	$_SESSION['userID']= $user["idFacebook"];
	
	header("Content-Type: application/json");
	$json_string = json_encode($user,JSON_PRETTY_PRINT);
	echo $json_string;
}
else
{
	header("Content-Type: application/json");
	$response = "0"
	$json_string = json_encode($response,JSON_PRETTY_PRINT);
	echo $json_string;
}
mysqli_close($con);
?>