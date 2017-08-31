<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php require_once(dirname(__FILE__) . '/../blocks/link.php'); ?>
    <title><?php echo $title; ?></title>
</head>
<body>
<?php require_once(dirname(__FILE__) . '/../blocks/header.php'); ?>
<form method="post" action="#">
    <p><input type="text" name="name" placeholder="Name" value="Kyrylo"></p>
    <p><input type="text" name="surname" placeholder="Surname" value="Hrechenyiuk"></p>
    <p><input type="text" name="login" placeholder="Login*" value="LyryKua"></p>
    <p><input type="email" name="email" placeholder="E-mail*" value="lyryk.ua@gmail.com"></p>
    <p><input type="password" name="password1" placeholder="Password*"></p>
    <p><input type="password" name="password2" placeholder="Confirm password*"></p>
    <p>
        <button type="submit" name="submit">Sign up</button>
    </p>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
</form>
<p>Have an account? <a href="/log-in">Log in</a></p>
<?php require_once(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>