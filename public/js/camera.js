/**
 * Created by khrechen on 9/26/17.
 */

'use strict';

var constraints = {
	video: true
};

var video = document.querySelector('video');
var dady = document.getElementById('camera');
var canvas = document.createElement('canvas');
var input_photo = document.getElementById('photo');
var button = document.getElementById('upload');
var context = canvas.getContext('2d');

canvas.width = 640;
canvas.height = 480;
canvas.style.backgroundColor = 'red';
canvas.style.transform = 'scaleX(-1)';

function handleSuccess(stream) {
	window.stream = stream; // stream available to console
	video.src = window.URL.createObjectURL(stream);
}

function handleError(error) {
	console.log('navigator.getUserMedia error: ', error);
}

navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);

function snapPhoto() {
	if (window.stream.active) {
		dady.replaceChild(canvas, video);
		context.drawImage(video, 0, 0);
		var data = canvas.toDataURL('image/png');
		input_photo.value = data;
		// console.log(data);
		button.disabled = false;
		button.style.color = '#e0f2ed';
		button.style.backgroundColor = '#82b4b1';
		button.style.cursor = 'pointer';
		window.stream.getVideoTracks()[0].stop();
	} else {
		navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);
		dady.replaceChild(video, canvas);
		button.disabled = true;
		button.style.color = '#6e6e6e';
		button.style.backgroundColor = '#b1b1b1';
		button.style.cursor = 'default';
	}
	// console.log(data);
}
