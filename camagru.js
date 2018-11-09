
var video_div = document.getElementById('video_div');
var canvas_div = document.getElementById('canvas_div');
var img_div = document.getElementById('img_div')
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var overlay = document.getElementById('overlay');
var snap = document.getElementById('snap');
var snapd = document.getElementById('snapd');
var snapp = document.getElementById('snapp');
var snapped = 0;
var s = 0;
var opath = "";

function update_overlay(name)
{
	s = 0;
	if (window.stream)
		snap.style.display = 'block';
	snapu.style.display = 'block';
	opath = "overlays/" + name + ".png";
	var img = new Image;
	img.onload = function() {
		canvas_div.style.display = 'block';
		overlay.getContext('2d').clearRect(0, 0, overlay.width, overlay.height);
		overlay.getContext('2d').drawImage(img, 0, 0, img.width, img.height);
	}
	img.src = opath;
}

canvas_div.addEventListener("wheel", scale_overlay);
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
		overlay.getContext('2d').drawImage(img, 
			((x)-(img.width+s)/2), ((y)-(img.height+s)/2),
			img.width + s, img.height + s
		);
	}
	img.src = opath;	
}
s = 0;
function scale_overlay(e)
{
	var img = new Image;
	img.onload = function() {
		s += e.deltaY > 0 ? 10: -10;
		if (s + img.width < 20 || s + img.height < 20)
			s = 0;
		position_overlay(e);
	}
	img.src = opath;
	e.preventDefault();
	e.stopPropagation();
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
	overlay.width = 320;
	overlay.height = 240;
	navigator.mediaDevices.getUserMedia({video: {width: 320, height: 240}, audio: false})
	.then(function(stream) {
		document.getElementById('snap').value = "Take picture";
		canvas_div.style.width = "320px";
		canvas_div.style.height = "240px";
		canvas.style.display = 'none';
		snap.style.display = 'none';
		snapd.style.display = 'none';
		snapp.style.display = 'none';
		snapu.style.display = 'none';
		startStream(stream);
	})
	.catch(function(error) {
		canvas_div.style.width = "320px";
		canvas_div.style.height = "240px";
		canvas.style.display = 'none';
		snap.style.display = 'none';
		snapd.style.display = 'none';
		snapp.style.display = 'none';
		snapu.style.display = 'none';
		alert("Your webcam is not enabled. You can still upload an image.");
	});
}

function discard_picture()
{
	start();
	snap.style.display = 'block';
	snapd.style.display = 'none';
	snapp.style.display = 'none';
	opath = "";
}

function post_picture()
{
	var img_pic = canvas.toDataURL("image/png", 0.9);
	var img_ovr = overlay.toDataURL("image/png", 0.9);
	var http = new XMLHttpRequest();
	http.open("POST", "newpost.php", true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function () {
		if (http.readyState == 4 && http.status == 200) {
			location.reload();
		}
	};
	var str = "pic="+img_pic+"&overlay="+img_ovr+"&w="+canvas.width+"&h="+canvas.height;
	http.send(str);
}

function snap_picture()
{
	if (window.stream == null)
		start();
	setTimeout(() => {
		canvas.style.display = 'block';
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext('2d').fillStyle="white";
		canvas.getContext('2d').fillRect(0, 0, canvas.width, canvas.height);
		canvas.getContext('2d').drawImage(video, 0, 0);
		snap.style.display = 'none';
		snapd.style.display = 'block';
		snapp.style.display = 'block';
		stopStream();
	}, 200); 
	return false;
}

function upload_picture() {
	if (window.stream) {
		stopStream();
	}
	snap.style.display = 'none';
	window.stream = null;
	var file = document.querySelector('input[type=file]').files[0];
	var reader  = new FileReader();
	reader.onloadend = function () {
		var img = new Image();
		img.onload = function () {
			if (img.width < 100 || img.width > 800 || img.height < 100 || img.height > 800)
				return alert("Your image needs to be larger than 100x100px and smaller than 800x800px.");
			canvas_div.style.display = 'block';
			canvas_div.style.width = img.width+"px";
			canvas_div.style.height = img.height+"px";
			overlay.width = img.width;
			overlay.height = img.height;
			canvas.width = img.width;
			canvas.height = img.height;
			canvas.style.display = 'block';
			canvas_div.style.display = 'block';
			canvas.getContext('2d').fillStyle="white";
			canvas.getContext('2d').fillRect(0, 0, canvas.width, canvas.height);
			canvas.getContext('2d').drawImage(img, 0, 0);
			var img1 = new Image;
			img1.onload = function() {
				canvas_div.style.display = 'block';
				overlay.getContext('2d').clearRect(0, 0, overlay.width, overlay.height);
				overlay.getContext('2d').drawImage(img1, 0, 0, img1.width, img1.height);
				snapd.style.display = 'block';
				snapp.style.display = 'block';
			}
			img1.src = opath;
		}
		img.src = reader.result;
	};
	reader.readAsDataURL(file);
}

start();
