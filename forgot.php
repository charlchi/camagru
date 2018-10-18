
<?php

require_once('header.php');

require_once('auth.php');
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	if ($login && $passwd && auth($login, $passwd))
	{
		echo "test";
		setcookie('login', $login, time() + (86400 * 30), "/");
		$db = unserialize(file_get_contents('resources/db'));
		$db['users'][$_COOKIE['login']]['logged_in'] = 1;
		file_put_contents('resources/db', serialize($db));
		header('Location: index.php');
	}
	else if ($login && $passwd)
	{
		$message = "Incorrect login credentials";
	}
}
?>

<div id="container">
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<div class= "block">
			<h1 style="color: #66ffff;">Reset password</h1>
			<?php echo "<b style='color:#330000;'>".$message; ?></b><br>
    		<label for="login">Email</label><br>
    		<input type="text" placeholder="Email" name="login" required><br><br>
			<button type="submit" name="submit" value="OK">Reset</button><br>
			<br>
			We'll send you an email with your new password.
		</div>
	</form>
</div>

</body>
</html>
