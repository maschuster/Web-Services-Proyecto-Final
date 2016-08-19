<?php

require_once("conexion.php");
$con = getConnection();

$idEventoGET = $_GET['idEvento'];
$query = 'SELECT * FROM participantes WHERE idEvento =' . $idEventoGET;
$result = mysqli_query($con, $query);

$participantes = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$idParticipante=$row['idParticipante'];
	$idEvento=$row['idEvento'];
	$idFacebook=$row['idFacebook'];
	$nombre=$row['nombre'];
	
	
	$participante = array('nombre'=> $nombre,'idEvento'=> $idEvento, 'idParticipante'=> $idParticipante, 'idFacebook'=> $idFacebook);
	
    $participantes[] = $particiante;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($participantes,JSON_PRETTY_PRINT);
echo $json_string;
?>
