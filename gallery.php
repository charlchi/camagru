<?php

$login = $_COOKIE['login'];

if ($login == '')
{
	header('Location: login.php');
}

echo "hi you are $login retarded";

?>