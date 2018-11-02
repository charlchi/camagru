<?php

require_once('header.php');

?>

<div id="container">
	
<?php

include_once("config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$db = db_open();
	
	try {
		$posts = $db->query("SELECT * FROM posts ORDER BY date DESC");
		foreach ($posts as $row) {
			if ($row['ID'] == intval($_GET['p'])) {
				$id = $row['user_id'] + 1;
				$sth = $db->prepare("SELECT username FROM users WHERE ID = $id");
				$sth->execute();
				$user = $sth->fetchColumn();
				echo "<div id='post$pid' class='post'>";
				echo "<div class='posttitle'>";
				echo "<span style='float: left;'>" . $user . "</span>";
				$diff = intval(($row['date'] - time()) / 60 / 60 / 24 * -1);
				echo "<span style='float: right;'>";
				echo  $diff == 0 ? "today" : "$diff days ago</span><br>";
				echo "</div>";
				echo "<img style='min-width: 30%; max-width:100%; max-height:100%;' src='";
				echo $row['path'];
				echo "' /><br>";
				echo "</div><br>";
			}
		}
	} catch (Exception $e) {
		echo "Error!: " . $e->getMessage() . "<br/>";
	}
}

?>

</div>

<?php

require_once('footer.php');

?>