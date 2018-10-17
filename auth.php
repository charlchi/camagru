<?php

function auth($login, $passwd)
{
	if (!file_exists('../private/passwd'))
		return false;
	$logins = unserialize(file_get_contents('../private/passwd'));
	$hashed = hash('whirlpool', $passwd);
	foreach ($logins as $k => $v)
		if ($v['login'] == $login && $v['passwd'] == $hashed)
			return true;
	return false;
}

?>