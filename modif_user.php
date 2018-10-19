
<?php

require_once('header.php');

?>

<script type="text/javascript">
	
function validate()
{
	var http = new XMLHttpRequest();
	http.open("POST", "parse_modif_user.php", true);
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
	["username", "nusername"].forEach(function (s, i) {
		poststr += s + "=" + document.forms["this"][s].value + "&";
	});
	http.send(poststr);
}

</script>

<div id="container">
	<form name="this" onsubmit="validate(); return false" autocomplete="off">
		<div class= "block">

			<h1 style="color: #8888ff;">Change username</h1>

			<span id="message" style='color:#ff0000'></span><br>

			<label for="username">Username</label><br>
			<input type="text" placeholder="Old username" name="username" required><br>

			<label for="nusername">New username</label><br>
			<input type="text" placeholder="New username" name="nusername" required><br>

			<button type="submit">Submit</button>

		</div>
	</form>
</div>


<?php

require_once('footer.php');

?>