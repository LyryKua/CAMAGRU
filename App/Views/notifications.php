<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/html.css">
	<style>

		form {
			margin: 100px 0 0;
			padding: 0;
			border: none;
		}

		button {
			display: block;
			margin: auto auto 10px;
			padding: 10px 20px;
			border: 0;
			border-radius: 3px;
			color: #82b4b1;
			background-color: #e0f2ed;
			text-transform: uppercase;
			font-weight: 600;
			outline: none;
			letter-spacing: 1px;
			font-size: 0.9em;
			cursor: pointer;
		}

		button:hover {
			/*border-bottom: 6px solid #e0f2ed;*/
			transition: 0.5s all;
			color: #e0f2ed;
			background-color: #82b4b1;
		}

		article {
			margin: 10px 0 0;
			text-align: center;
		}

		div.notification {
			padding-top: 10px;
			padding-bottom: 10px;
			transition: 0.5s all;
		}

		a {
			text-decoration: none;
			color: #82b4b1;
			transition: 0.5s all;
			font-size: 14px;
		}

		div.notification:hover {
			background: #dff1ec;
			transition: 0.5s all;
		}
	</style>
</head>
<body>

<?php
require_once('blocks/menu.php');
?>

<section class="content">
	<form action="#" method="post">
		<button type="submit" name="submit">Delete all notification</button>
	</form>
	<?php foreach ($notification as $item) : ?>
		<article>
			<a href="/post/<?php echo $item['photo'] ?>">
				<div class="notification">
					<span class="login"><?php echo $item['login'] ?></span><?php echo $item['text'] ?>
				</div>
			</a>
		</article>
	<?php endforeach; ?>

</section>

</body>
</html>