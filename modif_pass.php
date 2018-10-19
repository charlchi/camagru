
<?php

require_once('header.php');

?>

<script type="text/javascript">
	
function validate()
{
	var http = new XMLHttpRequest();
	http.open("POST", "parse_modif_pass.php", true);
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
	["pass", "npass"].forEach(function (s, i) {
		poststr += s + "=" + document.forms["this"][s].value + "&";
	});
	http.send(poststr);
}

</script>

<div id="container">
	<form name="this" onsubmit="validate(); return false" autocomplete="off">
		<div class= "block">

			<h1 style="color: #8888ff;">Change password</h1>

			<span id="message" style='color:#ff0000'></span><br>

			<label for="pass">Current</label><br>
			<input type="password" placeholder="Old Password" name="pass" required><br>

			<label for="npass">New</label><br>
			<input type="password" placeholder="New Password" name="npass" required><br>

    		<button type="submit">Submit</button>

		</div>
	</form>
</div>

<?php

require_once('footer.php');

?>