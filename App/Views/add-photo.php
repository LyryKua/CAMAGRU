<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/html.css">
	<script src="/js/camera.js"></script>

	<style>
		main {
			display: flex;
			flex-direction: column;
			align-items: center;
			/*margin-top: 290px;*/
		}

		div.container {
			margin-top: 122px;
			padding-top: 40px;
			border-radius: 10px;
			border: 1px solid #82b4b1;
			background-color: #f2f7e1;
			display: flex;
			flex-direction: column;
			align-items: center;
			width: 800px;
			/*background-color: red;*/
		}

		#camera {
			margin-bottom: 45px;
			display: flex;
			flex-direction: column;
			position: relative;
		}

		div.caption {
			padding: 20px;
			font-size: 0.9em;
			color: #82b4b1;
			text-align: center;
		}

		video {
			transform: scaleX(-1);
			width: 640px;
			height: 480px;
		}

		canvas, video {
			border-radius: 10px;
		}

		.frames {
			display: flex;
			justify-content: space-between;
			align-items: center;
			height: 150px;
			width: 640px;
		}

		.frame {
			width: 170px;
			height: 120px;
			background-repeat: no-repeat;
			/*margin: 10px;*/
			background-size: cover;
			/*background-position: center center;*/
			display: block;
			transition: 0.5s all;
		}

		.bunny {
			background-image: url(/templates/frames/bunny.png);
		}

		.ukraine {
			background-image: url(/templates/frames/ukraine.png);
		}

		.tv {
			background-image: url(/templates/frames/tv.png);
			width: 220px;
		}

		.bunny:hover, .ukraine:hover, .tv:hover {
			border: 3px solid #8cb2b0;
			transform: scale(1.2, 1.2);
			transition: 0.5s all;
			cursor: pointer;
		}

		#div_frame {
			background-image: url(/templates/frames/tv.png);
			background-size: 100% 100%;
			background-repeat: no-repeat;
			width: 640px;
			height: 480px;
			border-radius: 10px;
			position: absolute;
		}

		form {
			margin: 0;
			padding: 0;
			border: none;
		}

		button {
			display: block;
			margin: auto auto 10px;
			padding: 10px 20px;
			border: 0;
			border-radius: 3px;
			color: #6e6e6e;
			background-color: #b1b1b1;
			text-transform: uppercase;
			font-weight: 600;
			outline: none;
			letter-spacing: 1px;
			font-size: 0.9em;
			/*cursor: pointer;*/
		}

		/*button:hover {*/
		/*!*border-bottom: 6px solid #e0f2ed;*!*/
		/*transition: 0.5s all;*/
		/*color: #e0f2ed;*/
		/*background-color: #82b4b1;*/
		/*}*/

		a {
			text-decoration: underline;
			/*background: #f2f7e1;*/
			color: #87d1d0;
			cursor: pointer;
			/*padding: 10px;*/
			/*display: block;*/
			/*border-bottom: 1px solid #82b4b1;*/
			/*transition: 0.5s all;*/
			/*font-size: 14px;*/
		}

		input#file {
			display: none;
		}

	</style>
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
		<div class="caption">
			click on own picture or <a id="add">choose</a> file
		</div>
		<form action="#" method="post">
			<input type="file" accept="image/*" id="file">
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
		<script>
			add.onclick = function () {
				file.click();
			}
		</script>
		<script src="/js/camera.js"></script>
	</div>
</main>

</body>
</html>