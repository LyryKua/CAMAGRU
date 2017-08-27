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
<p><a href="/sign-up">new user? create account</a></p>
</body>
</html>