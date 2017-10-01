<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/reset-password2.css">
    <link rel="stylesheet" type="text/css" href="/css/blocks/header_for_log-in.css">
</head>
<body>
<header class="top">
    <div class="header">
        <div class="content">
            <div class="logo"><a href="/"><img src="/icons/logo2.png"></a></div>
            <div class="user"><a href="/log-in"><img src="/icons/user3.png"></a></div>
        </div>
    </div>
</header>

<div class="form-container">
    <div class="form-header">
        <h2>reset password</h2>
    </div>
    <form action="#" method="post">
        <label for="password1">password</label>
        <br>
        <input type="password" id="password1" name="password1">
        <label for="password2">confirm password</label>
        <br>
        <input type="password" id="password2" name="password2">
        <button type="submit">Reset password</button>
        <div>
            <a href="/log-in">Sign In</a>
            |
            <a href="/sign-up">Sign Up</a>
        </div>
    </form>
</div>
</body>
</html>