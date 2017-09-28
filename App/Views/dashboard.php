<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/html.css">
	<style>
		div.user_main {
			display: flex;
			margin-top: 122px;
			position: relative;
			z-index: 0;
		}

		div.user_main > div.avatar {
			height: 152px;
			width: 152px;
			margin-left: 50px;
			margin-bottom: 60px;
			border-radius: 50%;
			border: 3px solid #8cb3b1;
		}

		div.info {
			margin-left: 70px;
		}

		h1.login {
			font-size: 32px;
			line-height: 40px;
			font-weight: 200;
			margin-bottom: 0;
		}

		h2.name {
			font-weight: 600;
		}
	</style>
</head>
<body>

<?php require_once('blocks/menu.php'); ?>

<section class="content">

	<div class="user_main">
		<div style="background: url(<?php echo $_SESSION['logged_user']['avatar']; ?>);
				background-size: cover;" class="avatar">
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
					<img src="/<?php echo $item['path']; ?>">
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
					<div class="like"><a href="#" data-photo-id="<?php echo $item['photo_id']; ?>">Like</a></div>
					<div class="comment"><a href="#">Comment</a></div>
					<div class="share"><a href="#">Share</a></div>
				</section>
				<div class="likes"><?php echo $item['likes']; ?> likes</div>
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
					<input placeholder="Add a comment…">
				</form>
			</div>
		</article>
	<?php endforeach; ?>
</section>
</body>
</html>