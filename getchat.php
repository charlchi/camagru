<?php

$messages = unserialize(file_get_contents('../private/chat'));
foreach ($messages as $msg)
{
	echo '<span style="color:black;">'.$msg['user'].'</span>';
	echo ' : ';
	echo '<span style="color:red;">'.$msg['msg'].'</span>';
	echo '<br>';
}

?>