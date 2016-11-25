<?php
require_once("conexion.php");
$con = getConnection();

$id=$_GET["id"];
$query = "SELECT foto FROM eventos WHERE id=$id";
$query_exec = mysqli_query($con, $query);
if(mysqli_num_rows($query_exec)){
	$row=mysqli_fetch_assoc($query_exec);
	$foto = $row["foto"];
}
header("Content-Type: image/jpeg");
echo '<img src="data:image/jpeg;base64,'.base64_encode($foto).'"/>';
//echo $foto;
?>