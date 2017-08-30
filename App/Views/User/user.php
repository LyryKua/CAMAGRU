<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php require(dirname(__FILE__) . '/../blocks/link.php'); ?>
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
<?php require(dirname(__FILE__) . '/../blocks/header.php'); ?>
<?php
echo "<p>Hello, " . $users[0]['name'] . " " . $users[0]['surname'] . "<br>";
echo "I know your email: " . $users[0]['email'] . "</p>";
echo "<pre>" . var_dump($users[0]['registration_date']) . "</pre>";
?>
<?php require(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>