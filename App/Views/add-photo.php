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
			margin-top: 290px;
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

		div.camera {
			margin-bottom: 45px;
			display: flex;
			flex-direction: column;
		}

		div.caption {
			padding: 20px;
			font-size: 0.9em;
			color: #82b4b1;
			text-align: center;
		}

		video, canvas {
			transform: scaleX(-1);
			width: 640px;
			height: 480px;
			border-radius: 10px;
		}
	</style>
</head>
<body>

<?php require_once('blocks/menu.php'); ?>

<main>
	<div class="container">
		<div class="camera">
			<!--            <img src="/uploads/lyrykua/21372497_1938780743041100_8840145982072029184_n.jpg">-->
			<video id="video" autoplay></video>
			<button id="snap">Snap Photo</button>
			<canvas id="canvas" width="640" height="480"></canvas>
			<script src="/js/camera.js"></script>
		</div>
		<div class="caption">
			drop a photo or click on own picture
		</div>
	</div>
</main>

</body>
</html>