<?php

require_once("conexion.php");
$con = getConnection();
 
$idEventoGET = $_GET['idEvento'];
$query = 'SELECT * FROM preguntas
LEFT JOIN respuestas
ON preguntas.idPregunta = respuestas.idPregunta WHERE idEvento =' . $idEventoGET;
$result = mysqli_query($con, $query);

$votaciones = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['idPregunta'];
	$pregunta=$row['pregunta'];
	$afirmativos=$row['afirmativos'];
	$idEvento=$row['idEvento'];
	$negativos=$row['negativos'];
	
	$votacion = array('idPregunta'=> $id, 'pregunta'=> $pregunta, 'afirmativos'=> $afirmativos,'idEvento'=> $idEvento, 'negativos'=> $negativos);
	
    $votaciones[] = $votacion;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($votaciones,JSON_PRETTY_PRINT);
echo $json_string;
?>
