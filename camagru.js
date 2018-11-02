
var video_div = document.getElementById('video_div');
var canvas_div = document.getElementById('canvas_div');
var img_div = document.getElementById('img_div')
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var snap = document.getElementById('snap');
var overlay;
let streamvar;

function update_overlay()
{
	overlay = document.getElementById("img_overlay");
	overlay.src = "overlays/" + document.getElementById("overlay").value + ".png";
	overlay.style.display = "block";
	overlay.width = 200;
	overlay.height = 200;
	snap.style.display = 'block';
	return false;
}

function showMain()
{
	video_div.style.display = 'block';
}
function hideMain()
{
	video_div.style.display = 'none';
	snap_div.style.display = 'none';
	canvas_div.style.display = 'none';
}

function handleDevices(devices)
{
	for (var i = 0; i !== devices.length; ++i) {
		console.log("stuff " + devices[i].label);
	}
}

function startStream(stream)
{
	video.srcObject = stream;
	window.stream = stream;
}

function stopStream()
{
	video_div.style.display = 'none';
	stream.getTracks()[0].stop();
}

function start()
{
	streamvar = window.stream;
	var constraints = {video: {width: 320, height: 240}, audio: false};
	navigator.mediaDevices.getUserMedia(constraints)
	.then(function(stream) {
		startStream(stream);
		showMain();
	})
	.catch(function(error) {
		alert('getUserMedia error: ' + error.name, error);
		hideMain();
	});
}

function snap_picture()
{
	setTimeout(() => {
		canvas_div.style.display = 'block';
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext('2d').drawImage(video, 0, 0);
		stopStream();
	}, 200);
	return false;
}

var upload_pic = document.getElementById("upload");
upload_pic.addEventListener("change", upload_picture, false);
function upload_picture() {

	stopStream();
	var reader  = new FileReader();
	reader.onload() = function () {

		img.src = reader.result;
		canvas_div.style.display = 'block';
		canvas.width = img.width;
		canvas.height = img.height;
		console.log(img.width, img.height);
		canvas.getContext('2d').drawImage(img, 0, 0);
		update_overlay();
		canvas.getContext('2d').drawImage(overlay, 0, 0);
	
	};

	reader.readAsDataURL(this.files[0]);
}

start();
