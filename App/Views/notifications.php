<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/html.css">
	<link rel="stylesheet" type="text/css" href="/css/blocks/notifications.css">
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