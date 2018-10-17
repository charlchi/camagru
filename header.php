<?php

?>
<div id='header'>
	<a href='index.php'><div class='headeritem' id='item0' style='float: left'>Camagru</div></a>
	<?php 
	if ($_COOKIE['login'] == '')
	{
		echo "<a href='create.php'><div class='headeritem' id='item2' style='float: right'>Register</div></a>";
		echo "<a href='login.php'><div class='headeritem' id='item3' style='float: right'>Login</div></a>";
	}
	else
	{
		echo "<a href='logout.php'><div class='headeritem' id='item3' style='float: right'>Log out</div></a>"; 
	}
	?>
	<a href='gallery.php'><div class='headeritem' id='item3' style='float: right'>Gallery</div></a>
</div>
