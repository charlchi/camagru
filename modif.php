<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modify Account</title>
	<link rel="stylesheet" href="style.css"/>
</head>
<body>
	<?php
	require_once('header.php');
	function validate_form($p)
	{
		if ($p['login'] && $p['oldpw'] && $p['newpw'])
			return true;
		return false;
	}
	
	function find_user($logins, $login, $oldhash)
	{
		foreach ($logins as $k => $v)
			if ($v['login'] == $login && $v['passwd'] == $oldhash)
				return $k;
		return false;
	}

	$message = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$file = '../private/passwd'; 
		$valid = validate_form($_POST);
		$logins = false;
		if (file_exists($file))
			$logins = unserialize(file_get_contents($file));
	
		if ($_POST['oldpw'] == $_POST['newpw'])
			$message = "Passwords remained the same";
		elseif ($_POST['login'] != $_SESSION['logged_on_user'])
			$message = "Enter your username";
		elseif (!$valid)
			$message = "Invalid input";
		elseif ($valid && $logins)
		{
			$oldhash = hash('whirlpool', $_POST['oldpw']);
			$user = find_user($logins, $_POST['login'], $oldhash);
			if (!($user === false))
			{
				$logins[$user]['passwd'] = hash('whirlpool', $_POST['newpw']);
				file_put_contents($file, serialize($logins));
			}
			else { $message = "Username not found"; }
		}
		else { $message = "Invalid input"; }
	}
	?>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
		<div class= "block">
			<h1>Change Password</h1><br>
			<label for="login"><b>Username</b></label>
			<input type="text" placeholder="Username" name="login" required>
			<label for="passwd"><b>Password</b></label>
			<input type="password" placeholder="Old Password" name="oldpw" required>
			<input type="password" placeholder="New Password" name="newpw" required>
			<?php echo "<b style='color:red;'>".$message."</b><br>"; ?>
			<button type="submit">Update</button>
		</div>
	</form>
</body>
</html>