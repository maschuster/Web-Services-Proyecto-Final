<?php

require_once("conexion.php");
$con = getConnection();

$idEventoGET = $_GET['idEvento'];
$query = 'SELECT * FROM objetos WHERE idEvento =' . $idEventoGET;
$result = mysqli_query($con, $query);

$objetos = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['idObjeto'];
	$nombre=$row['nombre'];
	$precio=$row['precio'];
	$idEvento=$row['idEvento'];
	$idParticipante=$row['idParticipante'];
	$estado=$row['estado'];
	
	
	
	$objeto = array('idObjeto'=> $id, 'nombre'=> $nombre, 'precio'=> $precio,'idEvento'=> $idEvento, 'idParticipante'=> $idParticipante, 'estado'=> $estado );
	
    $objetos[] = $objeto;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($objetos,JSON_PRETTY_PRINT);
echo $json_string;
?>
