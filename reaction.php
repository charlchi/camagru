<?php

include_once("util.php");
include_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = $_POST;
	$db = db_open();
	try {
		$post_id = intval($post['id']);
		$stm = $db->prepare("INSERT INTO reactions ".
			"(user_id, post_id, type, data, date)".
			"VALUES (?, ?, ?, ?, ?)");
		$stm->execute(array(
			get_id($_COOKIE['username']),
			$post_id,
			intval($post['type']),
			$post['msg'],
			time()
		));
		if (intval($post['type']) == 0) {
			$sth = $db->prepare("SELECT user_id FROM posts WHERE ID = $post_id");
			$sth->execute();
			$user_id = $sth->fetch();
			$user_id = $user_id['user_id'];
			$sth = $db->prepare("SELECT * FROM users WHERE ID = $user_id");
			$sth->execute();
			$user = $sth->fetch();
			if ($user['sendmail'] == 1) {
				$mailhead = "Content-type: text/html; charset=iso-8859-1\r\n";
				$message = "Someone commented on one of your posts!";
				$sent = mail($user['email'], "Camagru : Comment", $message, $mailhead);
				if (!$sent)
					die("Email configuration invalid.");
			}
		}
	} catch (Exception $e) {
		die("Error!: " . $e->getMessage() . " <br/>");
	}	
}

?>