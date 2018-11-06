
var video_div = document.getElementById('video_div');
var canvas_div = document.getElementById('canvas_div');
var img_div = document.getElementById('img_div')
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var overlay = document.getElementById('overlay');
var snap = document.getElementById('snap');
var snapd = document.getElementById('snapd');
var snapp = document.getElementById('snapp');
var opath;

function update_overlay(name)
{
	snap.style.display = 'block';
	opath = "overlays/" + name + ".png";
	var img = new Image;
	img.onload = function() {
		canvas_div.style.display = 'block';
		overlay.getContext('2d').clearRect(0, 0, overlay.width, overlay.height);
		overlay.getContext('2d').drawImage(img, 0, 0, img.width, img.height);
	}
	img.src = opath;
}

canvas_div.addEventListener('click', position_overlay, true);
canvas_div.addEventListener('drag', position_overlay, true);
function position_overlay(e)
{
	var img = new Image;
	img.onload = function() {
		var rect = e.target.getBoundingClientRect();
		var x = e.clientX - rect.left;
		var y = e.clientY - rect.top;
		canvas_div.style.display = 'block';
		overlay.getContext('2d').clearRect(0, 0, overlay.width, overlay.height);
		overlay.getContext('2d').drawImage(img, x-img.width/2, y-img.height/2, img.width, img.height);
	}
	img.src = opath;	
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
	stream.getTracks()[0].stop();
	video.srcObject = null;
}

function start()
{
	overlay.width = 640;
	overlay.height = 480;
	navigator.mediaDevices.getUserMedia({video: {width: 640, height: 480}, audio: false})
	.then(function(stream) {
		document.getElementById('snap').value = "Take picture";
		canvas_div.style.width = "640px";
		canvas_div.style.height = "480px";
		canvas.style.display = 'none';
		snap.style.display = 'none';
		snapd.style.display = 'none';
		snapp.style.display = 'none';
		startStream(stream);
	})
	.catch(function(error) {
		alert('hi error: ' + error.name, error);
	});
}

function discard_picture()
{
	start();
	snap.style.display = 'block';
	snapd.style.display = 'none';
	snapp.style.display = 'none';
}

function snap_picture()
{
	if (window.stream == null)
		start();
	setTimeout(() => {
		canvas.style.display = 'block';
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext('2d').drawImage(video, 0, 0);
		snap.style.display = 'none';
		snapd.style.display = 'block';
		snapp.style.display = 'block';
		stopStream();
	}, 200); 
	return false;
}

/*
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
}*/

start();
