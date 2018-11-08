
<?php

if ($_COOKIE['username'] == '')
	header("location:gallery.php");

require_once('header.php');

?>

<script type="text/javascript">

function loadDoc(file) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("setting").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", file+".php", true);
	xhttp.send();
}

</script>

<div id="container">
	<button type="button" onclick="loadDoc('settings/modif_general')"> General settings </button>
	<button type="button" onclick="loadDoc('settings/modif_user')"> Username </button>
	<button type="button" onclick="loadDoc('settings/modif_pass')"> Password </button>
	<button type="button" onclick="loadDoc('settings/modif_email')"> Email </button>
	<br><br><div id="setting"></div>
</div>

<script type="text/javascript" src="settings/modif_user.js"></script>
<script type="text/javascript" src="settings/modif_pass.js"></script>
<script type="text/javascript" src="settings/modif_email.js"></script>
<script type="text/javascript" src="settings/modif_general.js"></script>

<?php

require_once('footer.php');

?>