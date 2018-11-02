
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
				window.location.href = "login.php";
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
	<form name="this" onsubmit="validate(); return false" autocomplete="off">
		<div class= "block">

			<h2>Register</h2>
			<h4>Fill in your details and we'll send you a confirmation email.</h4>

			<p id="message" style='color:#ff0000'></p>

    		<label for="username"> Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
    		<input type="text" placeholder="..." name="username" required><br/>

    		<label for="email"> Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    		<input type="text" placeholder="..." name="email" required><br/>

    		<label for="pass"> Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
    		<input type="password" placeholder="..." name="pass" required><br/>

    		<label for="cpass">Confirm password </label>
    		<input type="password" placeholder="..." name="cpass" required><br/>
    		<p></p>
    		<button type="submit">Register</button>
    		
		</div>
	</form>
</div>
<?php

require_once('footer.php');

?>