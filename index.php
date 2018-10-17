<?php
session_start();
?>

<?php
include_once("header.php")
?>

	<div id="container">

		<div><video id="video" autoplay="autoplay"></video></div>
		
		<div id="export_container">
			<div><input class='headeritem' id="snap" type="button" value="Smile!" onclick="picture()" /></div>
			<div id="picture"></div>
			<div><canvas id="canvas"></canvas></div>
			<input type="file" capture="camera" accept="image/*" id="cameraInput" name="cameraInput">
		</div>
	</div>
	
<script type="text/javascript">
	
"use strict";

var devices = navigator.mediaDevices;
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var snap = document.getElementById('snap');
var videoStream = null;



function start()
{
	var constraints = {video: { facingMode: "user" }, audio: false};
	devices.getUserMedia(constraints)
	.then(function(stream) {
		videoStream = stream;
		var source;
		//Get the stream. This goes to the video tag
		if (window.URL) {
			source = window.URL.createObjectURL(stream);
		} else if (window.webkitURL) {
			source = window.webkitURL.createObjectURL(stream);
		} else {
			source = stream; // Opera and Firefox
		}
		video.autoplay = true;
		video.src = source;
		video.style.display = 'block';
		snap.style.display = 'block';
		canvas.style.display = 'block';
	})
	.catch(function(){
		cameraInput.style.display = 'block';
		alert("Your browser is unsupported, or you don't have a webcam.")
	});
}

function picture()
{
	setTimeout(function(){
		canvas.style.display = 'block';
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext('2d').drawImage(video, 0, 0);
	}, 200);
}

start();

$('#cameraInput').on('change', function(e){
	$data = e.originalEvent.target.files[0];
	$reader = new FileReader();
	reader.onload = function(evt){
		$('#canvas').attr('src',evt.target.result);
		reader.readAsDataUrl($data);
		canvas.getContext('2d').drawImage($data, 0, 0);
		canvas.style.display = 'block';
	}
});

</script>

<?php
	include_once("footer.php")
?>

</body>
</html>
