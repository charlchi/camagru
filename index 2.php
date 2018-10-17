<!DOCTYPE html>
<html>
<head>
	<title>Rush01</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
</head>
<body>
	<script type="text/javascript">
		window.setInterval(function(){
			console.log('test');
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("txt").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "getchat.php", true);
			xmlhttp.send();

		}, 10);
	</script>
	<?php
	require_once('header.php');
	?>	
	<h1>Chat:</h1>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
		<input type="textfield" placeholder="Message" name="message">
		<button type="submit" name="submit" value="OK">OK</button>
	</form>
	<div id="txt" style="padding:5px; background-color: white; color: black;"></div>
	<?php
	if ($_POST['message'] != '' && $_SERVER["REQUEST_METHOD"] == "POST")
	{
		$messages = unserialize(file_get_contents('../private/chat'));
		$messages[] = array('user' => $_SESSION['logged_on_user'], 'msg' => $_POST['message']);
		file_put_contents('../private/chat', serialize($messages));
	}
	?>


</body>

