<?php

$db_name = "camagru";
$db_dsn = "mysql:host=localhost";
$db_user = "root";
$db_pass = "root";

function db_open()
{
	global $db_dsn, $db_name, $db_user, $db_pass;
	try {
		$db = new PDO("$db_dsn;dbname=$db_name", $db_user, $db_pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
}

?>