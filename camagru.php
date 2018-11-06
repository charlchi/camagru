<?php

// TODO:
// COPYSAMPLED
// .htaccess

session_start();

include_once("header.php");

?>

<div id="container">

	<div id="sidebar">
		Select an overlay:<br>
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
		<p>- You can move the overlay by clicking on the canvas, even after you took a photo</p>
	</div>

	<div id="canvas_div" onclick="update_overlay">
		<video id="video" playsinline autoplay style="position: absolute; left: 0; top: 0; z-index: 0;"></video>
		<canvas id="canvas" style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas>
		<canvas id="overlay" style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas>
	</div>

	<br style="clear:both;"/>



</div>

<p>&nbsp;Your previous posts:</p>

<?php
$db = db_open();

try {
	$posts = $db->query("SELECT * FROM posts ORDER BY date DESC");
	$logged = $_COOKIE['username'];
	$sth = $db->prepare("SELECT username FROM users WHERE username = $logged");
	$sth->execute();
	$id = $sth->fetchColumn();
} catch (Exception $e) {
	echo "Error!: " . $e->getMessage() . "<br/>";
}
?>


<script id="helper_script" src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="camagru.js"></script>

<?php

require_once('footer.php');

?>

