
<?php
require_once('header.php');
?>

<script type="text/javascript">

function loadDoc(file) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("setting").innerHTML = this.responseText;
			var js = document.createElement('script');
			js.type = 'text/javascript';
			js.src = file+'.js';
			document.body.appendChild(js);
		}
	};
	xhttp.open("GET", file+".php", true);
	xhttp.send();
}

</script>

<div id="container">
	<button type="button" onclick="loadDoc('settings/modif_settings')"> General settings </button><br>
	<button type="button" onclick="loadDoc('settings/modif_user')"> Username </button><br>
	<button type="button" onclick="loadDoc('settings/modif_pass')"> Password </button><br>
	<button type="button" onclick="loadDoc('settings/modif_email')"> Email </button><br>
	<br><div id="setting"></div>
</div>

<?php

require_once('footer.php');

?>