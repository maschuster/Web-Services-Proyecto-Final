<?php

require_once("conexion.php");

$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);

if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$idEventoGET = $_GET['idEvento'];
$query = 'SELECT * FROM personas WHERE idEvento =' . $idEventoGET;
$result = mysqli_query($con, $query);

$personas = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$nombre=$row['nombre'];
	$idEvento=$row['idEvento'];
	$idPersona=$row['idPersona'];
	
	
	$persona = array('nombre'=> $nombre,'idEvento'=> $idEvento, 'idPersona'=> $idPersona);
	
    $personas[] = $persona;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($objetos,JSON_PRETTY_PRINT);
echo $json_string;
?>
