<?php
require_once("conexion.php");
setlocale(LC_ALL,"es_ES");
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
	$descripcion=$row['descripcion'];
	$lugar=$row['lugar'];
	$foto = generarURL("/foto.php?id=".$row['idEvento']."&tabla=eventos");
	$fecha=$row['fecha'];
	
	$fecha = date_create($fecha);
	$fecha = date_format($fecha, 'j F   g:i A');
	
	$evento = array('idEvento'=> $id, 'nombre'=> $nombre, 'fecha'=> $fecha, 'lugar'=> $lugar,'descripcion'=> $descripcion, 'foto'=> $foto);
	
    $eventos[] = $evento;
	
}
$close = mysqli_close($con) 
or die("Ha sucedido un error inesperado en la desconexion de la base de datos");

header("Content-Type: application/json");
$json_string = json_encode($eventos,JSON_PRETTY_PRINT);
echo $json_string;
exit();



function generarURL($relativo) {
	return $GLOBALS["URL_BASE"] . $relativo;
}

?>
