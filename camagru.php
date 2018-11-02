<?php

// TODO:
// COPYSAMPLED
// .htaccess

session_start();

include_once("header.php");

?>

<div id="container">

	<div>
		Select Overlay: 
		<input id="overlay" list="overlay_list" onchange="update_overlay();" onmousedown="value = '';">
		<datalist id="overlay_list">
			<?php
			$files = array_diff(scandir("overlays"), array(".", ".."));
			echo "<option value='' selected disabled hidden>";
			foreach ($files as $image) {
				$name = (explode('.', $image))[0];
				echo "<option value='$name'>";
			}
			?>
		</datalist>
	</div>

	<div id="switchers">
		<p>Upload an image :</p><button id="upload" type="button" value="Upload picture from hard disk">
		<br>
		<p>Or take a picture :</p>
	</div>

	<!-- main webcam input -->
	<div id="img_div">
		<img id="img_overlay" src="#" style="display: none; position: absolute; text-align: none;">
	</div>
	<div id="canvas_div">
		<canvas id="canvas" style=""></canvas>
	</div>
	<div id="video_div">
		<video id="video" playsinline autoplay></video>
	</div>

	<br>

	<div id="snap"><input type="button" value="Smile!" onclick="snap_picture(); return false;" /></div>
	<br>
	<!-- result output -->

</div>

<script id="helper_script" src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="camagru.js"></script>

<?php

require_once('footer.php');

?>

