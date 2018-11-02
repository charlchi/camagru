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
	$count = $posts->fetchColumn();
	if ($count > 0)
		echo "<div style='padding:5px'>Page: "; 
	while ($i < $count) {
		$showval = $page + 1;
		echo " <a style='display:inline-block;text-decoration:none;' href=gallery.php?p=$page><div style='padding-left:8px;'>$showval</div></a>";
		$page++;
		$i += 6;
	}
	echo "</div>";
}

$db = db_open();

try {
	$posts = $db->query("SELECT * FROM posts ORDER BY date DESC");
	print_pages($posts);
	if ($_GET['p'] == 0)
		$_GET['p'] = 0;
	$start = intval($_GET['p']) * 6;
	$end = intval($_GET['p']) * 6 + 6;
	$i = 0;
	foreach ($posts as $row) {
		if ($i >= $start && $i < $end) {
			$id = $row['user_id'] + 1;
			$pid = $row['ID'];
			$user = $db->query("SELECT * FROM users WHERE ID = $id");
			echo "<a href='post.php?p=$pid'><div id='post$pid' class='post'>";
			foreach ($user as $u)
			{
				if ($u['ID'] == $id)
				{
					echo "<div class='posttitle'>";
					echo "<span style='float: left;'>" . $u['username'] . "</span>";
					$diff = intval(($row['date'] - time()) / 60 / 60 / 24 * -1);
					echo "<span style='float: right;'>";
					echo  $diff == 0 ? "today" : "$diff days ago</span><br>";
					echo "</div>";
				}
			}
			echo "<img style='min-width: 30%; max-width:100%; max-height:100%;' src='";
			echo $row['path'];
			echo "' /><br>";
			echo "</div></a><br>";
		}
		$i++;
	}
	$posts = $db->query("SELECT * FROM posts ORDER BY date DESC");
	print_pages($posts);
} catch (Exception $e) {
	echo "Error!: " . $e->getMessage() . "<br/>";
}

?>

</div>

<?php

require_once('footer.php');

?>