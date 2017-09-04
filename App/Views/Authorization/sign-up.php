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
    <p><input type="text" name="name" placeholder="Name" required value="Kyrylo"></p>
    <p><input type="text" name="surname" placeholder="Surname" required value="Hrechenyiuk"></p>
    <p><input type="text" name="login" placeholder="Login*" required value="LyryKua"></p>
    <p><input type="email" name="email" placeholder="E-mail*" required value="besiya@p33.org"></p>
    <p><input type="password" name="password1" placeholder="Password*" required value="function"></p>
    <p><input type="password" name="password2" placeholder="Confirm password*" required value="function"></p>
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