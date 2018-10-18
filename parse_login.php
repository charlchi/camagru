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
				if ($row['pass'] == hash("whirlpool", $post['pass'])) {
					setcookie("username", $post['username'], time() + 3600);
					echo "OK";
				}
			}
		}	
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	
}

?>