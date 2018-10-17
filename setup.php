<?php

include_once("camagru_db.php");

try {
	$db = new PDO("mysql:host=$db_host", $db_user, $db_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$exists = (bool) $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = $db_name");
	if ($exists)
		die("Database \"$db_name\" already exists!");
	$db->query("CREATE DATABASE $db_name");
	$db->query("use $db_name");
	//create table
	//populate
} catch (PDOException $e) {
	die("Error!: " . $e->getMessage() . "<br/>");
}

echo "Database \"$db_name\" succesfully created and populated!" . PHP_EOL;
