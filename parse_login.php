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
			if ($row['username'] == $post['username'] && $row['confirmed'] == 1) {
				if ($row['pass'] == hash("whirlpool", $post['pass'])) {
					$_SESSION['username'] = $post['username'];
					setcookie("username", $post['username'], time()+3600);
					die("OK");
				}
			}
		}
		echo "KO";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}	
}

?>