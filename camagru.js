
var devices = navigator.mediaDevices;
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var snap = document.getElementById('snap');
var videoStream = null;
var curr_overlay = null;

function update_overlay()
{
	var overlay = document.getElementById("img_overlay");
	overlay.src = "overlays/" + document.getElementById("overlay").value + ".png";
	overlay.style.display = "block";
	overlay.width = 200;
	overlay.height = 200;
	snap.style.display = 'block';
	return false;
}

function showMain()
{
	video.style.display = 'block';
}
function hideMain()
{
	video.style.display = 'none';
	snap.style.display = 'none';
	canvas.style.display = 'none';
}

function handleDevices(devices)
{
	for (var i = 0; i !== devices.length; ++i) {
		console.log("stuff " + devices[i].label);
	}
}

function start()
{
	navigator.mediaDevices.enumerateDevices().then(handleDevices);
	var constraints = {video: { facingMode: "user" }, audio: false};
	navigator.mediaDevices.getUserMedia(constraints)
	.then(function(stream) {
		var videotracks = stream.getVideoTracks();
		video.autoplay = true;
		video.srcObject = stream;
		window.stream = stream;
		showMain();
	})
	.catch(function(error) {
		alert('getUserMedia error: ' + error.name, error);
		hideMain();
		alert("Your browser is unsupported, or you don't have a webcam.");
	});
}

function snap_picture()
{
	setTimeout(function(){
		canvas.style.display = 'block';
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext('2d').drawImage(video, 0, 0);
	}, 200);
	return false;
}

start();

function upload_picture(input)
{
	video.style.display = 'none';
	input.addEventListener('change', function (e) {
		var img = new Image;
		img.onload = function () {
			canvas.style.display = 'block';
			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext('2d').drawImage(img, 0, 0);
		};
		img.src = URL.createObjectURL(e.target.files[0]);
	});
}
