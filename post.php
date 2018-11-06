<?php

require_once('header.php');

?>

<div id="container" style="">


<script type="text/javascript">
	
function comment()
{
	var msg = document.getElementById("commentfield").value;
	if (msg != '') {
		var http = new XMLHttpRequest();
		http.open("POST", "comment.php", true);
		http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		http.onreadystatechange = () => {
			if (http.readyState == 4 && http.status == 200) {
				location.reload();
			}
		};
		
		poststr = "msg="+msg;
		http.send(poststr);
	}
}

</script>
	
<?php

include_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$db = db_open();
	
	try {
		echo "<div id='post$pid' class='post' style='font-size: 0.95em'>";
		$posts = $db->query("SELECT * FROM posts ORDER BY date DESC");
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
		echo "<div style='float: left;'>" . $likes . " &hearts;</div><br><br>";
		
		$reactions = $db->query("SELECT * FROM reactions WHERE post_id = $postid ORDER BY date DESC");
		foreach ($reactions as $row) {
			if (intval($row['type']) == 0) {
				echo "<span style='float: left'><b>" . get_username($row['user_id']) . "</b> ";
				echo $row['data'];
				echo "</span><br>";
			}
		}
		echo "</div><br>";
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}

	if ($_COOKIE['username'] != '') {
		echo "<input id='commentfield' type='text' placeholder='...' name='pass' required>";
		echo "<input id='snapp' type='button' value='Comment' onclick='comment(); return false;' />";
	}

}

?>

</div>

<?php

require_once('footer.php');

?>