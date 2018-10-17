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
    .then(function(stream){
        videoStream = stream;
        if (window.webkitURL) video.src = window.webkitURL.createObjectURL(stream);
        else if (video.mozSrcObject !== undefined) video.mozSrcObject = stream;
        setTimeout(function(){
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
        }, 100);
    })
    .catch(function(){
        error("Your browser is unsupported, or you don't have a webcam.")
    });
}

function picture()
{
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	canvas.getContext('2d').drawImage(video, 0, 0);
}

start();
