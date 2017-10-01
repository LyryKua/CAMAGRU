<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/html.css">
	<script src="/js/camera.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/add-photo.css">
</head>
<body>

<?php require_once('blocks/menu.php'); ?>

<main>
	<div class="container">
		<div id="camera">
			<video id="web-camera" autoplay></video>
			<div id="div_frame" onclick="snapPhoto()"></div>
		</div>
		<div class="frames">
			<div class="frame ukraine" onclick="ukraine()"></div>
			<div class="frame tv" onclick="tv()"></div>
			<div class="frame bunny" onclick="bunny()"></div>
		</div>
		<form action="#" method="post">
			<div class="caption">
				click on own picture or <input type="file" accept="image/*" id="file">
			</div>
			<input type="hidden" name="photo" value="" id="photo">
			<input type="hidden" name="frame" value="tv" id="frame">
			<button type="submit" name="submit" disabled id="upload">UPLOAD</button>
		</form>
		<script>
			var div_frame = document.getElementById('div_frame');
			var input_frame = document.getElementById('frame');

			function ukraine() {
				div_frame.style.backgroundImage = 'url(/templates/frames/ukraine.png)';
				input_frame.value = 'ukraine';
			}
			function tv() {
				div_frame.style.backgroundImage = 'url(/templates/frames/tv.png)';
				input_frame.value = 'tv';

			}
			function bunny() {
				div_frame.style.backgroundImage = 'url(/templates/frames/bunny.png)';
				input_frame.value = 'bunny';

			}
		</script>
		<script src="/js/camera.js"></script>
		<script src="/js/upload.js"></script>
	</div>
</main>

</body>
</html>