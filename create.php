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
		if ($p['login'] && $p['passwd'] && $p['cpasswd'])
			return true;
		return false;
	}
	
	function account_exists($logins, $login)
	{
		foreach ($logins as $k => $v)
			if ($v['login'] == $login)
				return true;
		return false;
	}
	
	$message = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$dir = '../private';
		$file = '../private/passwd';
		if (!file_exists($dir))
			mkdir($dir);
		if (!file_exists($file))
			file_put_contents($file, null);
		$valid = validate_form($_POST);
		$logins = false;
		if (file_exists($file))
			$logins = unserialize(file_get_contents($file));
		if ($_POST['passwd'] != $_POST['cpasswd'])
			$message = "Passwords didn't match";
		elseif (!$valid)
			$message = "Invalid input";
		elseif (account_exists($logins, $_POST['login']))
			$message = "Username already in use";
		else
		{
			$account['login'] = $_POST['login'];
			$account['passwd'] = hash('whirlpool', $_POST['passwd']);
			$logins[] = $account;
			file_put_contents($file, serialize($logins));
			header('Location: login.php');
		}
	}
	?>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
		<div class= "block">
			<h1>Register</h1><br>
    		<label for="login"><b>Username</b></label>
    		<input type="text" placeholder="Enter Username" name="login" required><br/>
    		<label for="passwd"><b>Password</b></label>
    		<input type="password" placeholder="Enter Password" name="passwd" required><br/>
    		<label for="cpasswd"><b>Confirm&nbsp;</b></label>
    		<input type="password" placeholder="Confirm Password" name="cpasswd" required><br/>
    		<?php echo "<b style='color:red;'>".$message."</b><br>"; ?>
    		<button type="submit">Register</button>
		</div>
	</form>
</body>
</html>