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
		$users = $db->query("SELECT * FROM users");
		foreach ($users as $row) {
			if (hash("whirlpool", $post['pass']) == $row['pass']) {
				if (hash("whirlpool", $post['npass']) == $row['pass'])
					die("You've already used this password.");
				$stm = $db->prepare("UPDATE users SET pass = ? ".
					"WHERE username = ?");
				$stm->execute(array(hash("whirlpool", $post['npass']), $row['username']));
			}
		}
		echo "OK";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	
}

?>