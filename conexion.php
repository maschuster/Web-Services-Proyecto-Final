<?php

if (getenv("MYSQL_HOSTNAME") === false) {
	$_GLOBALS["MYSQL_HOSTNAME"] = "localhost";
	$_GLOBALS["MYSQL_USERNAME"] = "root";
	$_GLOBALS["MYSQL_PASSWORD"] = "";
	$_GLOBALS["MYSQL_DATABASE"] = "eventospf2016";
}
else {
	$_GLOBALS["MYSQL_HOSTNAME"] = getenv("MYSQL_HOSTNAME");
	$_GLOBALS["MYSQL_USERNAME"] = getenv("MYSQL_USERNAME");
	$_GLOBALS["MYSQL_PASSWORD"] = getenv("MYSQL_PASSWORD");
	$_GLOBALS["MYSQL_DATABASE"] = getenv("MYSQL_DATABASE");
}

function getCurrentUser() {
	if (array_key_exists("HTTP_X_USER_ID", $_SERVER)) {
		$id = $_SERVER["HTTP_X_USER_ID"];
		return $id;
	}
	else {
		http_response_code(500);
		die("No estas autenticado");
	}
}

?>