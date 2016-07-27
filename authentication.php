<?php
session_start();

require_once("conexion.php");
$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);
if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL" . mysqli_connect_error());
}

$jsonToken = file_get_contents('php://input'); 
$token = json_decode($jsonToken, true);
echo $token;
echo $token["accesToken"];
$url = "https://graph.facebook.com/me?access_token=". $token["accesToken"];
$json = @file_get_contents($url);

/*array(1) {
  ["accesToken"]=>
  string(118) "{AccessToken token:ACCESS_TOKEN_REMOVED permissions:[public_profile, contact_email, user_friends, email, user_photos]}"
}*/
if($json != false){
    $e = json_decode($json, true);
	$name = $e["name"];
    $id = $e["id"];
	$user = array('idFacebook'=> $id, 'nombre'=> $name);
	
	$query = 'SELECT * FROM usuarios WHERE idFacebook =' . $user["idFacebook"];
	$result = mysqli_query($con, $query);
	if (mysql_num_rows($result)==0) 
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