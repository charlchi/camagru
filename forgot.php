
<?php

include_once("util.php");
include_once("config/database.php");
require_once('header.php');

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$db = db_open();
	try {
		$address = htmlspecialchars($_POST['email']);
		$newpass = bin2hex(random_bytes(10)) . "1";
		$newhash = hash("whirlpool", $newpass);
		$stm = $db->prepare("UPDATE users SET pass = ? WHERE email = ?");
		$stm->execute(array($newhash, $address));
		$mailhead = "Content-type: text/html; charset=iso-8859-1\r\n";
		$mailmsg = "Your new Camagru password is $newpass";
		$sent = mail($_POST['email'], "Camagru : New password", $mailmsg, $mailhead);
		if (!$sent)
			die("Email invalid.");
		$message = "An email has been sent to your account with your new password.<br>Remember to change your password!<br>";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
}

?>

<div id="container">
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<div class= "block">
			<h1>Reset password</h1>
			<?php echo "<b style='color:#330000;'>".$message; ?></b><br>
    		<label for="login">Email</label><br>
    		<input type="text" placeholder="Email" name="email" required><br><br>
			<button type="submit" name="submit" value="OK">Reset</button><br>
			<br>
			We'll send you an email with your new password.
		</div>
	</form>
</div>

<?php

require_once('footer.php');

?>