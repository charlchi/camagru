<?php

require_once('header.php');

?>

<div id="container">

<?php

$login = $_COOKIE['username'];

echo "hi you are [$login]";

?>

</div>

<?php

require_once('footer.php');

?>