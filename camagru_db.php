<?php

$db_name = "camagru";
$db_host = "localhost";
$db_user = "admin";
$db_pass = "admin";

function db_open()
{
	try {
		$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	} catch (PDOException $e) {
		// TODO handle ERROR
		die("Error!: " . $e->getMessage() . "<br/>");
	}
}

?>