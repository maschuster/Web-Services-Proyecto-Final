<?php
require_once("conexion.php");
$con = getConnection();

$id=$_GET["id"];
$tabla=$_GET["tabla"];
$query = "SELECT foto FROM ".$tabla." WHERE id=".$_GET["id"];
$query_exec = mysqli_query($con, $query);
if(mysqli_num_rows($query_exec)){
	$row=mysqli_fetch_assoc($query_exec);
	$foto = $row["foto"];
}
header("Content-Type: image/jpeg");
var_dump($foto);
echo $foto;
?>