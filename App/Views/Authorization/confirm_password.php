<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php require(dirname(__FILE__) . '/../blocks/link.php'); ?>
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
<?php require(dirname(__FILE__) . '/../blocks/header.php'); ?>

<?php if ($confirm === true) : ?>
    <h1>Your email was verified.</h1>
<?php else: ?>
    <h1>You are already confirmed your account</h1>
<?php endif; ?>
<?php require(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>