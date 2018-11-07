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
				$stm->execute(array(1, $_COOKIES['username']));
			} else if ($post['mail'] == "true") {
				$stm = $db->prepare("UPDATE users SET sendmail = ? WHERE username = ?");
				$stm->execute(array(0, $_COOKIES['username']));
			}
		}
		echo "OK";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	
}

?>