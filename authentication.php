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
		
    $id = $e["id"];
    $email = $e["email"];
    $name = $e["name"];
	$user = array('idFacebook'=> $id, 'email'=> $email, 'name'=> $name);
	
	$query = 'SELECT * FROM usuarios WHERE idFacebook =' . $id;
	$result = mysqli_query($con, $query);
	if (mysql_num_rows($result)==0) 
	{
		$query = "INSERT INTO usuarios (idFacebook,nombre,email) values (?, ?, ?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param(
			'sss',
			$user["id"],
			$user["name"],
			$user["email"]
		);
		$stmt->execute();
		$res = $stmt->get_result();
	}
	$_SESSION['userID']= $user["id"];
	return json_encode($user);
	}else {
    $response = array("success" => "0");
		return json_encode($response);
   }
?>