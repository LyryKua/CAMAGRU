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
    <style>
        section.content > article {
            margin: 122px 0 0;
        }
    </style>
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
		<header class="avatar_login">
			<div class="avatar">
				<img src="/<?php echo $photo['avatar']; ?>">
			</div>
			<div class="login">
				<span class="login"><?php echo $photo['login']; ?></span>
			</div>
		</header>
		<div class="photo">
			<img src="/<?php echo $photo['path']; ?>">
		</div>
		<div class="footer">
			<?php if (isset($_SESSION['logged_user'])) : ?>
				<section class="like_comment_share">
					<div class="like">
						<a href="#" data-photo-id="<?php echo $photo['photo_id']; ?>">Like</a>
					</div>
					<div class="comment">
						<a onclick="comment()">Comment</a>
					</div>
				</section>
				<div class="likes"><?php echo $photo['likes']; ?> likes</div>
			<?php endif; ?>
			<ul class="comments">
				<?php foreach ($photo['comments'] as $comment) : ?>
					<li>
							<span class="login">
								<?php echo $comment['login']; ?>
							</span>
						<span class="text">
								<?php echo $comment['text']; ?>
							</span>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php if (isset($_SESSION['logged_user'])) : ?>
				<form action="#" method="post">
					<input placeholder="Add a comment…" name='comment' id="<?php echo 'add_comment' . $photo_id; ?>">
					<input type="hidden" name="photo_id" value="<?php echo $photo_id; ?>">
				</form>
			<?php endif; ?>
		</div>
	</article>

	<script>
		function comment() {
			id.focus();
		}
	</script>

</section>

</body>
</html>