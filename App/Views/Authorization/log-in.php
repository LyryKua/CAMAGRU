<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php require(dirname(__FILE__) . '/../blocks/link.php'); ?>
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
<?php require(dirname(__FILE__) . '/../blocks/header.php'); ?>
<form method="post" action="#">
    <p><input type="text" name="login" placeholder="Login*" required value="pup"></p>
    <p><input type="password" name="password" placeholder="Password*" required value="function"></p>
    <p>
        <button type="submit" name="submit">Log in</button>
    </p>
	<?php
	if (isset($error)) {
		echo "<p>$error</p>";
	}
	?>
    <p><a href="/reset-password">Forgot password?</a></p>
</form>
<p>Don't have an account? <a href="/sign-up">Sign up</a></p>
<?php require(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>