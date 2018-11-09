<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:500|Share+Tech+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
	<link rel="stylesheet" href="style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" type="text/css" media="all">
</head>
<body>

<div id='header'>
	<?php
	if (!isset($_COOKIE['username']) || $_COOKIE['username'] == '')
	{
		echo "<a class='headeritem' href='gallery.php?p=0'  >Gallery</a>";
		echo "<a class='headeritem' href='login.php'      >Login</a>";
		echo "<a class='headeritem' href='register.php'>Register</a>";
	}
	else
	{
		echo "<a class='headeritem' href='camagru.php'    >Camagru</a>";
		echo "<a class='headeritem' href='gallery.php?p=0'  >Gallery</a>";
		echo "<a class='headeritem' href='settings.php'>Settings</a>";
		echo "<a class='headeritem' href='logout.php'    >Logout</a>";
	}

	?>
</div>