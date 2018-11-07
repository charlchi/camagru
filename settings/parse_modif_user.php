<?php

include_once("../util.php");
include_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = validate_post($_POST);
	if (is_string($post))
		die($post);
	$db = db_open();
	try {
		if ($_COOKIE['username'] != $post['username']) {
			die("Original username incorrect.");
		}
		$users = $db->query("SELECT * FROM users");
		foreach ($users as $row) {
			if ($row['username'] == $post['nusername']) {
				die("Username already exists.");
			}
		}
		$users = $db->query("SELECT * FROM users");
		foreach ($users as $row) {
			if ($row['username'] == $_COOKIE['username']) {
				$stm = $db->prepare("UPDATE users SET username = ? ".
					"WHERE username = ?");
				$stm->execute(array($post['nusername'], $_COOKIE['username']));
				setcookie('username', $post['nusername'], time()+360000, "/");
			}
		}
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	
}

?>