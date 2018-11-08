<?php

include_once("../util.php");
include_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = $_POST;
	$db = db_open();
	try {
		foreach ($db->query("SELECT * FROM users") as $row) {
			if ($post['mail'] == "true") {
				$stm = $db->prepare("UPDATE users SET sendmail = ? WHERE username = ?");
				$stm->execute(array(1, $_COOKIE['username']));
			} else if ($post['mail'] == "false") {
				$stm = $db->prepare("UPDATE users SET sendmail = ? WHERE username = ?");
				$stm->execute(array(0, $_COOKIE['username']));
			}
		}
		echo "OK";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	
}

?>