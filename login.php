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
	require_once('auth.php');
	$message = "";
	$usertip = "Enter Username";
	$passtip = "Enter Password";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$login = $_POST['login'];
		$passwd = $_POST['passwd'];
		if ($login == 'admin' && $passwd == 'admin')
		{
			$_SESSION['logged_on_user'] = 'admin';
			header('Location: admin_index.php');
		}
		if ($login && $passwd && auth($login, $passwd))
		{
			if (file_exists('resources/'.$_SESSION['logged_on_user']) == false)
				file_put_contents('resources/'.$_SESSION['logged_on_user'], null);
			$_SESSION['logged_on_user'] = $login;
			header('Location: index.php');
		}
		else if ($login && $passwd)
		{
			$message = "Incorrect login credentials";
		}
	}
	?>

	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<div class= "block">
			<h1>Login</h1><br>
    		<label for="login"><b>Username</b></label>
    		<input type="text" placeholder="<?php echo $usertip; ?>" name="login" required>
			<br/>
    		<label for="passwd"><b>Password</b></label>
    		<input type="password" placeholder="<?php echo $passtip; ?>" name="passwd" required>

    		<?php echo "<b style='color:red;'>".$message."</b><br>"; ?>

    		<button type="submit" name="submit" value="OK">Login</button>
		</div>
	</form>
	<br/>
</body>
</html>
