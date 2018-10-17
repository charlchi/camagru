<?php

session_start();

$_COOKIE['login'] = '';
setcookie('login', '', time() + (86400 * 30), "/");
header('Location: login.php');

?>