<?php

include_once("util.php");
include_once("config/database.php");

error_reporting(-1);
ini_set('display_errors', 'On');

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = $_POST;
	$db = db_open();
	try {
		$file  = "images/post".time().".png";
		$w = intval($post['w']);
		$h = intval($post['h']);
		$pstr = preg_replace('#^data:image/\w+;base64,#i', '', str_replace(' ', '+', $post['pic']));
		$ostr = preg_replace('#^data:image/\w+;base64,#i', '', str_replace(' ', '+', $post['overlay']));
		$picdata = base64_decode($pstr);
		$ovrdata = base64_decode($ostr);
		$bot = imagecreatefromstring($picdata);
		$top = imagecreatefromstring($ovrdata);
		imagecopyresampled($bot, $top, 0, 0, 0, 0, $w, $h, $w, $h);
		imagepng($bot, $file, 9);
		imagedestroy($bot);
		imagedestroy($top);
		$stm = $db->prepare("INSERT INTO posts ".
			"(user_id, path, date)".
			"VALUES (?, ?, ?)");
		$stm->execute(array(
			get_id($_COOKIE['username']),
			$file,
			time()
		));
	} catch (Exception $e) {
		die($e->getMessage());
	}	
}

?>