<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php require(dirname(__FILE__) . '/../blocks/link.php'); ?>
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
<?php require(dirname(__FILE__) . '/../blocks/header.php'); ?>
<form action="/log-in">
    <p><input type="text" placeholder="Name"></p>
    <p><input type="text" placeholder="Surname"></p>
    <p><input type="text" placeholder="Login"></p>
    <p><input type="email" placeholder="E-mail"></p>
    <p><input type="password" placeholder="Password"></p>
    <p><input type="password" placeholder="Confirm password"></p>
    <p>
        <button type="submit">Sign up</button>
    </p>
</form>
</body>
</html>