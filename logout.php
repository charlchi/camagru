<?php

session_start();
session_destroy();
$_COOKIE['username'] = "";
setcookie("username", "", time() - 360000, "/");
header('Location: login.php');

?>