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
	<p>
		<button>web cam</button>
	 or <input type="file"></p>
</form>
<?php require(dirname(__FILE__) . '/../blocks/footer.php'); ?>
</body>
</html>