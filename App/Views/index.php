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
		.pages{
			display: flex;
			/*align-items: center;*/
			justify-content: center;
		}

		.pages > li a {
			margin: 0 5px 20px;
			text-decoration: none;
			background: #f2f7e1;
			color: #82b4b1;
			padding: 10px;
			display: block;
			/*border-bottom: 1px solid #82b4b1;*/
			transition: 0.5s all;
			font-size: 14px;
			border-radius: 4px;
		}
		li.middle a{
			background: #82b4b1;
			color: #f2f7e1;
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
	<?php foreach ($photos as $item) : ?>
		<article>
			<header class="avatar_login">
				<div class="avatar">
					<img src="<?php echo $item['avatar']; ?>">
				</div>
				<div class="login">
					<span class="login"><?php echo $item['login']; ?></span>
				</div>
			</header>
			<a href="/post/<?php echo $item['photo_id']; ?>">
				<div class="photo">
					<img src="/<?php echo $item['path']; ?>">
				</div>
			</a>
			<div class="footer">
				<?php if (isset($_SESSION['logged_user'])) : ?>
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
					<div class="likes" id="like<?php echo $item['photo_id']; ?>"><?php echo $item['likes']; ?> likes
					</div>
				<?php endif; ?>
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
				<?php if (isset($_SESSION['logged_user'])) : ?>
					<form action="#" method="post">
						<input placeholder="Add a comment…" name='comment'
							   id="<?php echo 'add_comment' . $item['photo_id']; ?>">
						<input type="hidden" name="photo_id" value="<?php echo $item['photo_id']; ?>">
					</form>
				<?php endif; ?>
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
	<ul class="pages">
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li class="middle"><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
	</ul>
</body>
</html>
