
<?php

require_once('header.php');


if ($_SERVER["REQUEST_METHOD"] == "POST")
{

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
