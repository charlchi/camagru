<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="all">
</head>
<body>

<?php
include_once("header.php")
?>

	<div id="container">

		<div><video id="video" autoplay="autoplay"></video></div>
		
		<div id="export_container">
			<div><input class='headeritem' id="snap" type="button" value="Say cheese!" onclick="picture()" /></div>
			<div id="picture"></div>
			<div><canvas id="canvas"></canvas></div>
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
    var constraints = {video: true, audio: false};
    devices.getUserMedia(constraints)
    .then(function(stream) {
        videoStream = stream;
        if (window.webkitURL) video.src = window.webkitURL.createObjectURL(stream);
        else if (video.mozSrcObject !== undefined) video.mozSrcObject = stream;
    	video.style.display = 'block';
    })
    .catch(function(){
        error("Your browser is unsupported, or you don't have a webcam.")
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

<?php
	include_once("footer.php")
?>

</script>

</body>
</html>
