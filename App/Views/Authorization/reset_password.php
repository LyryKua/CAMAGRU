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
    <p><input type="text" name="value" placeholder="Login or email" required value=""></p>
	<?php
	if (isset($error)) {
		echo "<p>$error</p>";
	}
	?>
    <p>
        <button type="submit" name="submit">Reset Password</button>
    </p>
</form>
<p>Have an account? <a href="/log-in">Log in</a></p>
<?php require(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>