<?php

require_once('header.php');

?>

<div id="container">

<?php

$login = $_COOKIE['username'];

echo "Hi $login!";

?>

</div>

<?php

require_once('footer.php');

?>