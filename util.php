<?php

function strip_str($str) {
	$str = trim($str);
	$str = stripslashes($str);
	$str = htmlspecialchars($str);
	return $str;
}

function validate_post($post) {
	$ret = array();
	if (isset($post['username'])) {
		$username = strip_str($post['username']);
		if (!preg_match("/^[a-zA-Z]*$/", $username))
			return "Your username may only contain letters";
		$ret['username'] = $username;
	}
	if (isset($post['email'])) {
		$email = strip_str($post['email']);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			return "Invalid email format";
		$ret['email'] = $email;
	}
	if(isset($post["pass"])) {
		$pass = strip_str($post['pass']);
		if (strlen($pass) <= '8')
		    return "Password requires at least 8 characters";
		else if(!preg_match("#[0-9]+#", $pass))
		    return "Password requires at least 1 number";
		$ret['pass'] = $pass;
	}
	if(isset($post["cpass"])) {
		$cpass = strip_str($post['cpass']);
		if (strlen($cpass) <= '8')
		    return "Password requires at least 8 characters";
		else if(!preg_match("#[0-9]+#", $post['cpass']))
		    return "Password requires at least 1 number";
		$ret['cpass'] = $cpass;
	}
	return $ret;
}

?>