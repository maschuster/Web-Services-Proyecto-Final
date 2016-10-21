<?php

require_once("conexion.php");
$con = getConnection();
$user = getCurrentUser();

$query = 'SELECT eventos.*, participantes.idFacebook
FROM eventos
LEFT JOIN participantes
ON eventos.idEvento = participantes.idEvento
WHERE idFacebook =' . $user['idFacebook'];


$result = mysqli_query($con, $query);

$eventos = array();

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['idEvento'];
	$nombre=$row['nombre'];
	$fecha=$row['fecha'];
	$descripcion=$row['descripcion'];
	$lugar=$row['lugar'];
	$foto=$row['foto'];
	
	$evento = array('idEvento'=> $id, 'nombre'=> $nombre, 'fecha'=> $fecha, 'lugar'=> $lugar,'descripcion'=> $descripcion, 'foto'=> $foto);
	
    $eventos[] = $evento;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($eventos,JSON_PRETTY_PRINT);
echo $json_string;
exit();
?>
