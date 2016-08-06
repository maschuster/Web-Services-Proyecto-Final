<?php

session_start();

if (getenv("MYSQL_HOSTNAME") === false) {
	$_GLOBALS["MYSQL_HOSTNAME"] = "localhost";
	$_GLOBALS["MYSQL_USERNAME"] = "root";
	$_GLOBALS["MYSQL_PASSWORD"] = "";
	$_GLOBALS["MYSQL_DATABASE"] = "eventospf2016";
}
else {
	$_GLOBALS["MYSQL_HOSTNAME"] = getenv("MYSQL_HOSTNAME");
	$_GLOBALS["MYSQL_USERNAME"] = getenv("MYSQL_USERNAME");
	$_GLOBALS["MYSQL_PASSWORD"] = getenv("MYSQL_PASSWORD");
	$_GLOBALS["MYSQL_DATABASE"] = getenv("MYSQL_DATABASE");
}

function getCurrentUser() {

	if (array_key_exists("USER_ID", $_SESSION)) {
		$id = $_SESSION["USER_ID"];
		
		$con=mysqli_connect($GLOBALS["MYSQL_HOSTNAME"], $GLOBALS["MYSQL_USERNAME"], $GLOBALS["MYSQL_PASSWORD"], $GLOBALS["MYSQL_DATABASE"]);
		if (mysqli_connect_errno()) {
			die("Failed to connect to MySQL" . mysqli_connect_error());
		}
		$query = 'SELECT * FROM usuarios WHERE idFacebook = ' . $id;
		$result = mysqli_query($con, $query);
		if($row = mysqli_fetch_array($result)) 
		{ 
		$idfb=$row['idFacebook'];
		$nombre=$row['nombre'];
	
		$user = array('idFacebook'=> $idfb, 'nombre'=> $nombre);
		}
		return $user;
	}
	
	
	else {
		http_response_code(500);
		die("No estas autenticado");
	}
}

function getConnection(){
$con = mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	return $con;
}

?>