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
    <input type="text" placeholder="Login">
    <input type="password" placeholder="Password">
    <button type="submit">Log in</button>
</form>
<p>Don't have an account? <a href="/sign-up">Sign up</a></p>
<?php require(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>