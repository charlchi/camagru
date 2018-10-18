<?php

include_once("util.php");
include_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = validate_post($_POST);
	if (is_string($post))
		die($post);

	$db = db_open();
	try {
		foreach ($db->query("SELECT * FROM users") as $row) {
			if ($row['username'] == $post['username']) {
				echo "Username already exists.";
			} else if ($post['pass'] != $post['cpass']) {
				echo "Passwords didn't match.";
			}
		}	
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	
}

?>