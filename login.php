
<?php

require_once('header.php');

?>

<script type="text/javascript">
	
function validate()
{
	var http = new XMLHttpRequest();
	http.open("POST", "parse_login.php", true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function() {
		var message = document.getElementById("message");
		if (http.readyState == 4 && http.status == 200) {
			var response = http.responseText;
			if (response == "OK")
				window.location.href = "index.php";
			else
				message.innerHTML = response;
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

			<h1>Login</h1>

			<span id="message" style='color:#ff0000'></span><br>

    		<label for="username"> Username </label><br>
    		<input type="text" placeholder="..." name="username" required><br>

    		<label for="pass"> Password </label><br>
    		<input type="password" placeholder="..." name="pass" required><br>

    		<a href="forgot.php" style="font-size:12px; color:black;">Forgot Password?</a><br>

			<input type="submit" value="Login">
			
		</div>
	</form>
</div>

<?php

require_once('footer.php');

?>