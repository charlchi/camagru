
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
		elseif ($_POST['login'] != $_COOKIE['login'])
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

<div id="container">
	<h3>&nbsp;&nbsp;Modify account</h3>
	<a href="modif_user.php" style="color: black;">
		Change username</a><br>
	<a href="modif_pass.php" style="color: black;">
		Change password</a><br>
	<a href="modif_email.php" style="color: black;">
		Change email</a><br>
</div>

<?php

require_once('footer.php');

?>