<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
	<link rel="stylesheet" href="style.css" type="text/css" media="all">
</head>
<body>

<div id='header'>
	<?php 
	if ($_COOKIE['username'] == '')
	{
		echo "<a href='gallery.php'>Gallery</a>";
		echo "<a href='login.php'>Login</a>";
		echo "<a href='register.php'>Register</a>";
	}
	else
	{
		echo "<a href='index.php'>Camagru</a>";
		echo "<a href='gallery.php'>Gallery</a>";
		echo "<a href='settings.php'>Settings</a>";
		echo "<a href='logout.php'>Logout</a>";
	}
	echo "<br style='clear: both;' />";
	?>
</div>
<br>
