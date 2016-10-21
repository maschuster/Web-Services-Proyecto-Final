<?php

require_once("conexion.php");
$con = getConnection();
 
$idEventoGET = $_GET['idEvento'];
$id = $_SERVER["HTTP_X_PARTICIPANTE_ID"];
$query = "SELECT preguntas.idPregunta, preguntas.idEvento, preguntas.pregunta, preguntas.afirmativos, preguntas.negativos, respuestas.voto FROM preguntas
LEFT JOIN respuestas
ON preguntas.idPregunta = respuestas.idPregunta AND respuestas.idParticipante = $id WHERE preguntas.idEvento = $idEventoGET;";

$result = mysqli_query($con, $query);

$votaciones = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['idPregunta'];
	$pregunta=$row['pregunta'];
	$afirmativos=$row['afirmativos'];
	$idEvento=$row['idEvento'];
	$negativos=$row['negativos'];
	if($row['voto'] == null){
		$voto = "0";
	}else{
		$voto=$row['voto'];
	}

	
	$votacion = array('idPregunta'=> $id,  'pregunta'=> $pregunta, 'afirmativos'=> $afirmativos,'idEvento'=> $idEvento, 'negativos'=> $negativos, 'voto'=> $voto);
	
    $votaciones[] = $votacion;
}

//$close = mysqli_close($con) 
//or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json; charset=utf-8");
$json_string = json_encode($votaciones,JSON_PRETTY_PRINT);
echo $json_string;
?>
