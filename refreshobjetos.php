<?php

require_once("conexion.php");

$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);

if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$idEventoGET = $GET_['idEvento']
$query = 'SELECT * FROM objetos WHERE idEvento =' $idEventoGET;
$result = mysqli_query($con, $query);

$objetos = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['idObjeto'];
	$nombre=$row['nombre'];
	$precio=$row['precio'];
	$idEvento=$row['idEvento'];
	$idUsuario=$row['idUsuario'];
	$estado=$row['estado'];
	
	//va estado o no??
	
	
	$objeto = array('idObjeto'=> $id, 'nombre'=> $nombre, 'precio'=> $precio,'idEvento'=> $idEvento, 'idUsuario'=> $idUsuario, 'estado'=> $estado );
	
    $objetos[] = $objeto;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($objetos,JSON_PRETTY_PRINT);
echo $json_string;
?>
