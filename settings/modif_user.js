
function validate()
{
	var http = new XMLHttpRequest();
	http.open("POST", "settings/parse_modif_user.php", true);
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