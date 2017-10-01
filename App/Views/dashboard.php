<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/html.css">
	<link rel="stylesheet" type="text/css" href="/css/dashboard.css">
</head>
<body>

<?php require_once('blocks/menu.php'); ?>

<section class="content">

	<div class="user_main">
		<div style="background: url(<?php echo $_SESSION['logged_user']['avatar']; ?>);
				background-size: cover; background-position: center center;" class="avatar">
		</div>
		<div class="info">
			<h1 class="login"><?php echo $_SESSION['logged_user']['login']; ?></h1>
			<span class="photos"><?php echo $posts; ?> posts</span>
			<h2 class="name"><?php echo $_SESSION['logged_user']['firstname'] . " " . $_SESSION['logged_user']['lastname']; ?></h2>
		</div>
	</div>

	<?php foreach ($photos as $item) : ?>
		<article>
			<header class="avatar_login">
				<div class="avatar">
					<img src="/<?php echo $_SESSION['logged_user']['avatar']; ?>">
				</div>
				<div class="login">
					<span class="login"><?php echo $_SESSION['logged_user']['login']; ?></span>
				</div>
			</header>
			<a href="/post/<?php echo $item['photo_id']; ?>">
				<div class="photo">
					<img src="/<?php echo $item['path']; ?>">
				</div>
			</a>

			<div class="footer">
				<section class="like_comment_share">
					<div class="like">
						<a <?php if (in_array(['user' => $_SESSION['logged_user']['user_id'], 0 => $_SESSION['logged_user']['user_id'], 'photo' => $item['photo_id'], 1 => $item['photo_id']], $like)) {
							echo "class='liked'";
						} ?> data-photo-id="<?php echo $item['photo_id']; ?>" onclick="addLike(this)">Like</a>
					</div>
					<div class="comment">
						<a onclick="comment(<?php echo 'add_comment' . $item['photo_id']; ?>)">Comment</a>
					</div>
				</section>
				<div class="likes" id="like<?php echo $item['photo_id']; ?>"><?php echo $item['likes']; ?> likes</div>
				<ul class="comments">
					<?php foreach ($item['comments'] as $comment) : ?>
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
				<form action="#" method="post">
					<input placeholder="Add a comment…" name='comment'
						   id="<?php echo 'add_comment' . $item['photo_id']; ?>">
					<input type="hidden" name="photo_id" value="<?php echo $item['photo_id']; ?>">
				</form>
			</div>

		</article>
	<?php endforeach; ?>
	<script>
		function comment(id) {
			id.focus();
		}
	</script>
	<script src="js/like.js"></script>
</section>
</body>
</html>