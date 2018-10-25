<?php

include_once("database.php");

try {
	$db = new PDO("$db_dsn", $db_user, $db_pass);
	$db->query("DROP DATABASE camagru");
} catch (PDOException $e) {
	die("Error!: " . $e->getMessage() . "<br/>");
}

?>