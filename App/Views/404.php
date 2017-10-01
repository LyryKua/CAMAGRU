<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<?php if (isset($_SESSION['logged_user'])) : ?>
		<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<?php else : ?>
		<link rel="stylesheet" type="text/css" href="/css/blocks/header.css">
	<?php endif; ?>
	<link rel="stylesheet" type="text/css" href="/css/html.css">
	<link rel="stylesheet" type="text/css" href="/css/blocks/404.css">
</head>
<body>

<?php
if (isset($_SESSION['logged_user'])) {
	require_once('blocks/menu.php');
} else {
	require_once('blocks/header.php');
}
?>

<section class="content">
		<article>
			<h1>404</h1>
			<h2>Page does not exist!</h2>
		</article>
</section>
</body>
</html>
