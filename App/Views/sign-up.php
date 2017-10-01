<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="/css/blocks/header.css">
	<link rel="stylesheet" type="text/css" href="/css/sign-up.css">
</head>
<body>

<?php require_once('blocks/header.php'); ?>

<div class="form-container">
    <div class="form-header">
        <h2>sign up</h2>
    </div>
    <form action="#" method="post">
        <label for="login">Login</label>
        <br>
        <input type="text" id="login" name="login" value="<?php if (isset($login)) {
			echo $login;
		} ?>">
        <label for="email">email</label>
        <br>
        <input type="email" id="email" name="email" value="<?php if (isset($email)) {
			echo $email;
		} ?>">
        <label for="password1">Password</label>
        <br>
        <input type="password" id="password1" name="pass1">
        <label for="password2">confirm password</label>
        <br>
        <input type="password" id="password2" name="pass2">
		<?php if (isset($e)) {
			echo "<div style='color: #ed4956; font-size: 1.3em; margin-bottom: 20px;'>" . $e . "</div>";
		} ?>
        <button type="submit" name="submit">sign up</button>
        <div>
            <a href="/log-in">Sign In</a>
        </div>
    </form>
</div>
</body>
</html>