<?php

include_once("database.php");

$db = new PDO("$db_dsn", $db_user, $db_pass);
$db->query("DROP DATABASE camagru");

?>