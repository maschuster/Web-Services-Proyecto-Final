<?php
require_once("conexion.php");
$con = getConnection();

$id=$_GET["id"];
$query = "SELECT foto FROM eventos WHERE idEvento=$id";
$query_exec = mysqli_query($con, $query);
if(mysqli_num_rows($query_exec)){
	$row=mysqli_fetch_assoc($query_exec);
	$foto = $row["foto"];
}
header("Content-Type: image/jpeg");
echo $foto;
?>