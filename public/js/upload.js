/**
 * Created by khrechen on 9/26/17.
 */

'use strict';
function renderImage(file) {
	var video = document.querySelector('video');
	var dad = document.getElementById('camera');
	var canvas = document.createElement('canvas');
	var button = document.getElementById('upload');
	var context = canvas.getContext('2d');

	canvas.width = 640;
	canvas.height = 480;
	canvas.background = 'red';
	canvas.style.transform = 'scaleX(-1)';

	var reader = new FileReader();
	reader.onload = function (event) {
		var the_url = event.target.result;
		var image = new Image();
		console.log(image);
		image.onload = function () {
			dad.replaceChild(canvas, video);
			context.drawImage(image, 0, 0, 640, 480);
			var data = canvas.toDataURL('image/png');
			input_photo.value = data;
			// console.log(data);
			button.disabled = false;
			button.style.color = '#e0f2ed';
			button.style.backgroundColor = '#82b4b1';
			button.style.cursor = 'pointer';
			window.stream.getVideoTracks()[0].stop();
		}
		image.src = the_url;
	}
	reader.readAsDataURL(file);
}
function previewImages() {
	var file = document.getElementById('file').files[0];
	renderImage(file);
}
document.getElementById('file').addEventListener('change', previewImages, false);