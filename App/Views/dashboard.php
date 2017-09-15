<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>camagru</title>
    <link rel="stylesheet" type="text/css" href="/css/blocks/header.css">
    <link rel="stylesheet" type="text/css" href="/css/html.css">
    <style>
        div.user_main {
            display: flex;
            margin-top: 290px;
        }

        div.user_main > div.avatar {
            height: 152px;
            width: 152px;
            margin-left: 50px;
            margin-bottom: 60px;
            border-radius: 50%;
        }

        div.user_main > div.avatar + div {
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

<?php require_once('blocks/header.php'); ?>

<section class="content">

    <div class="user_main">
        <div style="background: url(<?php echo $_SESSION['logged_user']['avatar']; ?>) no-repeat;
            background-size: auto 100%;" class="avatar">
        </div>
        <div>
            <h1 class="login">lyrykua</h1>
            <span class="photos">42 posts</span>
            <h2 class="name">Name Surname</h2>
        </div>
    </div>

    <article>
        <header class="avatar_login">
            <div class="avatar">
                <img src="/uploads/lyrykua/21372497_1938780743041100_8840145982072029184_n.jpg">
            </div>
            <div class="login">
                <span class="login">ivanchuk.maksim</span>
            </div>
        </header>
        <div class="photo">
            <img src="/uploads/lyrykua/21372975_133239207211693_2754060491939643392_n.jpg">
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
    <article>
        <header class="avatar_login">
            <div class="avatar">
                <img src="/uploads/lyrykua/21372497_1938780743041100_8840145982072029184_n.jpg">
            </div>
            <div class="login">
                <span class="login">ivanchuk.maksim</span>
            </div>
        </header>
        <div class="photo">
            <img src="/uploads/lyrykua/21373486_117074285659989_6553989131553210368_n.jpg">
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
    <article>
        <header class="avatar_login">
            <div class="avatar">
                <img src="/uploads/lyrykua/21372497_1938780743041100_8840145982072029184_n.jpg">
            </div>
            <div class="login">
                <span class="login">ivanchuk.maksim</span>
            </div>
        </header>
        <div class="photo">
            <img src="/uploads/lyrykua/21480248_760965594088328_1407578791420624896_n.jpg">
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
    <article>
        <header class="avatar_login">
            <div class="avatar">
                <img src="/uploads/lyrykua/21372497_1938780743041100_8840145982072029184_n.jpg">
            </div>
            <div class="login">
                <span class="login">ivanchuk.maksim</span>
            </div>
        </header>
        <div class="photo">
            <img src="/uploads/lyrykua/21433945_1844057402573619_4936365883644706816_n.jpg">
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