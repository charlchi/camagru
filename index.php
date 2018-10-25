<?php

// TODO:
// COPYSAMPLED
// .htaccess

session_start();

include_once("header.php");

?>

<div id="container">

	<div id="switchers">
		<p>Upload an image :</p><input type="file" value="Upload an image" onchange="upload_picture(this); return false;" style="display:inline-block;" />
		<br>
		<p>Or take a picture :</p>
	</div>

	<!-- main webcam input -->
	<div>
		<div id="export_container" style="position: absolute;">
			<img id="img_overlay" src="#" style="display: none; position: absolute; text-align: none;">
			<canvas id="canvas" style=""></canvas>
		</div>
		<video id="video" autoplay="autoplay" style=""></video>
	</div>

	<br>

	<div>
		Select Overlay: 
		<input id="overlay" type="text" list="overlay_list" onchange="update_overlay();" onmousedown="value = '';">
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
	<div id="snap"><input type="button" value="Smile!" onclick="snap_picture(); return false;" /></div>
	<br>
	<!-- result output -->

</div>


<script type="text/javascript" src="camagru.js"></script>

<?php

require_once('footer.php');

?>
