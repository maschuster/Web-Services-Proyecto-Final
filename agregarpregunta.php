<?php

require_once("conexion.php");
$con = getConnection();

$string = file_get_contents('php://input'); 
$votacion = json_decode($string, true);
$votos = 0;
$query = "INSERT INTO preguntas (pregunta, afirmativos, negativos, idEvento) values (?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param(
	'ssss',
	$votacion["pregunta"],
	$votos,
	$votos,
	$votacion["idEvento"]
	
);
$stmt->execute();
$stmt->get_result();
$resultado = mysqli_insert_id($con);
if($resultado < 1){
	http_response_code(500);
	die("Error agregando Pregunta");
}

mysqli_close($con);

?>