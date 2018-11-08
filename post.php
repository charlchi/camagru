<?php

require_once('header.php');

?>

<div id="container" style="">

<span id="message"></span>

<script type="text/javascript">
	
function react(postid, type)
{
	var msg = document.getElementById("commentfield").value;
	if (type == 1 || (msg != '' && type == 0)) {
		var http = new XMLHttpRequest();
		http.open("POST", "reaction.php", true);
		http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		http.onreadystatechange = function() {
			if (http.readyState == 4 && http.status == 200) {
				location.reload();
			}
		};
		poststr = "msg="+msg+"&id="+postid+"&type="+type;
		http.send(poststr);
	}
}

function deletepost(pid)
{
	console.log("hi");
	var http = new XMLHttpRequest();
	http.open("POST", "deletepost.php", true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function() {
		if (http.readyState == 4 && http.status == 200) {
			window.location.href = "gallery.php";
		}
	};
	poststr = "pid="+pid;
	http.send(poststr);
}

</script>
	
<?php

include_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$db = db_open();
	
	if (!isset($_GET['p']))
		header("Location:gallery.php");
	try {
		$pid = intval($_GET['p']);
		if ($pid != 0)
			echo "<div id='post$pid' class='post' style='font-size: 0.95em'>";
		$posts = $db->query("SELECT * FROM posts ORDER BY date DESC");
		$user = "";
		foreach ($posts as $row) {
			if ($row['ID'] == intval($_GET['p'])) {
				$id = $row['user_id'];
				$sth = $db->prepare("SELECT username FROM users WHERE ID = $id");
				$sth->execute();
				$user = $sth->fetchColumn();
				echo "<div class='posttitle'>";
				echo "<b style='float: left;'>" . $user . "</b>";
				$diff = intval(($row['date'] - time()) / 60 / 60 / 24 * -1);
				echo "<span style='float: right;'>";
				echo  $diff == 0 ? "today" : "$diff days ago</span><br>";
				echo "</div>";
				echo "<img style='max-width: 40%; max-width:100%; max-height:100%;' src='";
				echo $row['path'];
				echo "' /><br>";
			}
		}
		$postid = intval($_GET['p']);
		$likes = 0;
		$reactions = $db->query("SELECT * FROM reactions WHERE post_id = $postid ORDER BY date DESC");
		foreach ($reactions as $row) {
			if (intval($row['type']) == 1) {
				$likes += 1;
			}
		}
		if ($pid != 0)
			echo "<div style='float: left;'>" . $likes . " &hearts;</div><br><br>";
		$reactions = $db->query("SELECT * FROM reactions WHERE post_id = $postid ORDER BY date DESC");
		foreach ($reactions as $row) {
			if (intval($row['type']) == 0) {
				echo "<span style='float: left'><b>" . get_username($row['user_id']) . "</b> ";
				echo $row['data'];
				echo "</span><br>";
			}
		}
		if ($pid != 0)
			echo "</div><br>";
		if ($_COOKIE['username'] != '' && $pid != 0) {
			echo "<input id='commentfield' type='text' placeholder='...' name='pass' required>";
			echo "<input id='comm' type='button' value='Comment' onclick='react($pid, 0); return false;' />";
			echo "<input id='like' type='button' value='Like' onclick='react($pid, 1); return false;' />";
		}
		if ($_COOKIE['username'] != "" && $_COOKIE['username'] == $user)
			echo "<br><br><input id='delete' type='button' value='Delete this post' onclick='deletepost($pid); return false;' />";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
	$dbh = null;
}

?>

</div>

<?php

require_once('footer.php');

?>