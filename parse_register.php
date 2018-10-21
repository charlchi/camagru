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
		if ($post['pass'] != $post['cpass']) {
			die("Passwords didn't match.");
		}
		foreach ($db->query("SELECT * FROM users") as $row) {
			if ($row['username'] == $post['username']) {
				die("Username already exists.");
			}
		}
		$mailhead = "Content-type: text/html; charset=iso-8859-1\r\n";
		$message = "<html><body><p>".
			"Click <a href='http://".$_SERVER['HTTP_HOST']."/camagru/confirm.php?token=".
			hash("whirlpool", $post['username'])."'>here</a>".
			"</p></body></html>";
		$sent = mail($post['email'], "Camagru password confirmation", $message, $mailhead);
		if (!$sent)
			die("Email configuration invalid.");
		$stm = $db->prepare("INSERT INTO users ".
			"(username, pass, email, confirmed) ".
			"VALUES (?, ?, ?, ?)");
		$stm->execute(array(
			$post['username'],
			hash("whirlpool", $post['pass']),
			$post['email'],
			0
		));
		echo "OK";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
}

?>