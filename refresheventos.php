<?php
session_start();
require_once("conexion.php");
$con=mysqli_connect($_GLOBALS["MYSQL_HOSTNAME"], $_GLOBALS["MYSQL_USERNAME"], $_GLOBALS["MYSQL_PASSWORD"], $_GLOBALS["MYSQL_DATABASE"]);
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userID = getCurrentUser();

$query = 'SELECT eventos.*, participantes.idFacebook
FROM eventos
LEFT JOIN participantes
ON eventos.idEvento = participantes.idEvento
WHERE idFacebook =' . $userID;


$result = mysqli_query($con, $query);

$eventos = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['idEvento'];
	$nombre=$row['nombre'];
	$fecha=$row['fecha'];
	$descripcion=$row['descripcion'];
	$lugar=$row['lugar'];
	
	$evento = array('idEvento'=> $id, 'nombre'=> $nombre, 'fecha'=> $fecha, 'lugar'=> $lugar,'descripcion'=> $descripcion);
	
    $eventos[] = $evento;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($eventos,JSON_PRETTY_PRINT);
echo $json_string;
exit();
?>
