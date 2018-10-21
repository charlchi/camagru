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

		foreach ($db->query("SELECT * FROM users") as $row) {
			if ($post['email'] == $row['email']) {
				if ($post['nemail'] == $row['email'])
					die("You've already used this email.");
				$stm = $db->prepare("UPDATE users SET email = ? ".
					"WHERE username = ?");
				$stm->execute(array($post['nemail'], $row['username']));
			}	
		}
		echo "OK";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	
}

?>