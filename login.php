
<?php

require_once('header.php');

?>

<script type="text/javascript">
	
function validate()
{
	var http = new XMLHttpRequest();
	http.open("POST", "parse_login.php", true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = () => {
		var message = document.getElementById("message");
		if (http.readyState == 4 && http.status == 200) {
			if (http.responseText == "OK")
				window.location.href = "gallery.php";
			else
				message.innerHTML = http.responseText;
		}
	};
	poststr = "";
	["username", "pass"].forEach(function (s, i) {
		poststr += s + "=" + document.forms["this"][s].value + "&";
	});
	http.send(poststr);
}

</script>

<div id="container">
	<form name="this" onsubmit="validate(); return false" autocomplete="off">
		<div class= "block">

			<h2>Login</h2>

			<p id="message" style='color:#ff0000'></p>

    		<label for="username"> Username </label>
    		<input type="text" placeholder="..." name="username" required><br>

    		<label for="pass"> Password </label>
    		<input type="password" placeholder="..." name="pass" required><br>

    		<p><a href="forgot.php" style="font-size:12px; color:black;">Forgot Password?</a></p>
			<input type="submit" value="Login">
			
		</div>
	</form>
</div>

<?php

require_once('footer.php');

?>