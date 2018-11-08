<?php

include_once("util.php");
include_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = $_POST;
	$db = db_open();
	try {
		$post_id = intval(htmlspecialchars($post['pid']));
		$stm = $db->prepare("DELETE FROM posts WHERE ID = ?");
		$stm->execute(array($post_id));
	} catch (Exception $e) {
		die("Error!: " . $e->getMessage() . " <br/>");
	}	
}

?>