<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
	<link rel="stylesheet" href="style.css" type="text/css" media="all">
</head>
<body>

<div id='header'>
	<a href='index.php'>Camagru</a>
	<?php 
	if ($_COOKIE['login'] == '')
	{
		echo "<a href='gallery.php'>Gallery</a>";
		echo "<a href='register.php'>Register</a>";
		echo "<a href='login.php'>Login</a>";
	}
	else
	{
		echo "<a href='gallery.php'>Gallery</a>";
		echo "<a href='settings.php'>Settings</a>";
		echo "<a href='logout.php'>Log out</a>";
	}
	?>
</div>