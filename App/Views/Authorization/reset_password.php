<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php require(dirname(__FILE__) . '/../blocks/link.php'); ?>
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
<?php require(dirname(__FILE__) . '/../blocks/header.php'); ?>
<form action="#">
    <p><input type="text" placeholder="Login or email"></p>
    <p>
        <button type="submit">Reset Password</button>
    </p>
</form>
<p>Have an account? <a href="/log-in">Log in</a></p>
<?php require(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>