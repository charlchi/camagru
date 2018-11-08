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

function get_username($id)
{
	try {
		$db = db_open();
		$user = $db->query("SELECT * FROM users");
		foreach ($user as $u)
		{
			if ($u['ID'] == $id)
			{
				return $u['username'];
			}
		}
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
}

function get_id($username)
{
	try {
		$db = db_open();
		$user = $db->query("SELECT * FROM users");
		foreach ($user as $u)
		{
			if ($u['username'] == $username)
			{
				return $u['ID'];
			}
		}
	} catch (PDOException $e) {
		die("Error!: " . $e->getMessage() . "<br/>");
	}
}

?>