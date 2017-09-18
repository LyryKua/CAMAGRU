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
            margin: 290px 0 0;
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
                <img src="/uploads/petrovalida/927213_648972511807873_1593024856_n.jpg">
            </div>
            <div class="login">
                <span class="login">ivanchuk.maksim</span>
            </div>
        </header>
        <div class="photo">
            <img src="/uploads/petrovalida/927213_648972511807873_1593024856_n.jpg">
        </div>
        <div class="footer">
            <section class="like_comment_share">
                <div class="like"><a href="#">Like</a></div>
                <div class="comment"><a href="#">Comment</a></div>
                <div class="share"><a href="#">Share</a></div>
            </section>
            <div class="likes">42 likes</div>
            <ul class="comments">
                <li><span class="login">ivanchuk.maksim</span><span class="text">пвд начинается :)</span></li>
                <li><span class="login">vikaplusak</span><span class="text">1 фессалоникийцам 5:18</span></li>
                <li><span class="login">naty_ivanova_</span><span class="text">Ахах) веселые времена)</span></li>
            </ul>
            <form>
                <input placeholder="Add a comment…">
            </form>
        </div>
    </article>
</section>

</body>
</html>