<?php

// TODO:
// upload a picture from drive
// delete own posts

session_start();

if ($_COOKIE['username'] == '')
	header("location:gallery.php");

include_once("header.php");

?>

<div id="containermain">

	<div id="sidebar">
		<h3>Select an overlay:</h3>
		<?php
		$files = array_diff(scandir("overlays"), array(".", ".."));
		foreach ($files as $image) {
			$name = (explode('.', $image))[0];
			echo "<input type='button' value='$name' onclick='update_overlay(this.value); return false;' />";
		}
		?>
		<p></p>
		<input id="snap" type="button" value="Take picture" onclick="snap_picture(); return false;" />
		<p></p>
		<input id="snapd" type="button" value="Discard" onclick="discard_picture(); return false;" />
		<p></p>
		<input id="snapp" type="button" value="Post" onclick="post_picture(); return false;" />
	</div>

	<div id="canvas_div" onclick="update_overlay">
		<video id="video" playsinline autoplay style="position: absolute; left: 0; top: 0; z-index: 0;"></video>
		<canvas id="canvas" style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas>
		<canvas id="overlay" style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas>
	</div>

	<br style="clear:both;"/>



</div>

<p>&nbsp;Your previous posts:</p>

<div style="display:inline-block; margin:15px; overflow-x: scroll; white-space: nowrap; border: 1px solid #ddd">
<?php

include_once("config/database.php");

$db = db_open();

try {
	$posts = $db->query("SELECT * FROM posts ORDER BY ID");
	$logged = $_COOKIE['username'];
	$sth = $db->prepare("SELECT ID FROM users WHERE username = '$logged'");
	$sth->execute();
	$id = $sth->fetchColumn();
	$i = 0;
	foreach ($posts as $post) {
		if ($post['user_id'] == $id) {
			$pid = $post['ID'];
			echo "<a href='post.php?p=$pid'><div id='post$pid' class='post'>";
			echo "<img style='width: 100px;' src='";
			echo $post['path'];
			echo "' />";
			echo "</div></a>";
			$i++;
		}
		if ($i > 0 && $i % 5 == 0)
			echo "<br>";
	}
} catch (Exception $e) {
	echo "Error!: " . $e->getMessage() . "<br/>";
}

?>
</div>

<script id="helper_script" src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="camagru.js"></script>

<?php

require_once('footer.php');

?>

