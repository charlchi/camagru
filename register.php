
<?php

require_once('header.php');

?>

<script type="text/javascript">
	
function validate()
{
	var http = new XMLHttpRequest();
	http.open("POST", "parse_register.php", true);
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
	["username", "email", "pass", "cpass"].forEach(function (s, i) {
		poststr += s + "=" + document.forms["this"][s].value + "&";
	});
	http.send(poststr);
}

</script>

<div id="container">
	<form name="this" onsubmit="validate(); return false">
		<div class= "block">

			<h1 style="color: #8888ff;">Register</h1>

			<span id="message" style='color:#ff0000'></span><br>

    		<label for="username"> Username </label><br>
    		<input type="text" placeholder="..." name="username" required><br/>

    		<label for="email"> Email &nbsp;&nbsp;&nbsp;</label><br>
    		<input type="text" placeholder="..." name="email" required><br/>

    		<label for="pass"> Password </label><br>
    		<input type="password" placeholder="..." name="pass" required><br/>

    		<label for="cpass"> Confirm &nbsp;&nbsp;</label><br>
    		<input type="password" placeholder="..." name="cpass" required><br/>

    		<button type="submit">Register</button>
    		
		</div>
	</form>
</div>
</body>
</html>