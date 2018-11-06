<?php

include_once("util.php");
include_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = $_POST;
	$db = db_open();
	try {
		$stm = $db->prepare("INSERT INTO users ".
			"(user_id, post_id, type, data, date)".
			"VALUES (?, ?, ?, ?, ?)");
		$stm->execute(array(
			1,
			1,
			0,
			$post['msg'],
			date()
		));
	} catch (Exception $e) {

	}	
}

?>