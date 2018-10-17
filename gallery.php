<?php

require_once('header.php');

?>

<div id="container">

<?php

$login = $_COOKIE['login'];

if ($login == '')
{
	header('Location: login.php');
}

echo "hi you are $login retarded";

?>

</div>

</body>
</html>