<?php

require_once('header.php');

?>

<div id="container">
	
<?php

include_once("config/database.php");

function print_pages($posts)
{
	$i = 0;
	$page = 0;
	$count = count($posts);
	if ($count > 5)
	{
		if ($count > 0)
			echo "<div style='padding:5px'>Page: "; 
		while ($i < $count - 1) {
			$showval = $page + 1;
			echo " <a style='display:inline-block;text-decoration:none;' href=gallery.php?p=$page><div style='padding-left:8px;'>$showval</div></a>";
			$page++;
			$i += 6;
		}
		echo "</div>";
	}
	
}

try {
	$db = db_open();
	$posts = $db->query("SELECT * FROM posts ORDER BY date DESC")->fetchAll();
	print_pages($posts);
	if (!isset($_GET['p']) || $_GET['p'] == 0)
		$_GET['p'] = 0;
	$start = intval($_GET['p']) * 6;
	$end = intval($_GET['p']) * 6 + 6;
	$i = 0;
	for ($x = 0; $x < count($posts); $x++) {
		$row = $posts[$x];
		if ($i >= $start && $i < $end) {
			$id = $row['user_id'];
			$pid = $row['ID'];
			echo "<a href='post.php?p=$pid'><div id='post$pid' class='post'>";
			echo "<div class='posttitle'>";
			echo "<span style='float: left;'>" . get_username($id) . "</span>";
			$diff = intval(($row['date'] - time()) / 60 / 60 / 24 * -1);
			echo "<span style='float: right;'>";
			echo  $diff == 0 ? "today" : "$diff days ago</span><br>";
			echo "</div>";
			echo "<img style='min-width: 30%; max-width:100%; max-height:100%;' src='";
			echo $row['path'];
			echo "' /><br>";
			echo "</div></a><br>";
		}
		$i++;
	}
	$posts = $db->query("SELECT * FROM posts ORDER BY date DESC")->fetchAll();
	print_pages($posts);
	$dbh = null;
} catch (Exception $e) {
	echo "Error!: " . $e->getMessage() . "<br/>";
}

?>

</div>

<?php

require_once('footer.php');

?>