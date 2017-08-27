<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php require ('blocks/link.php'); ?>
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
    <?php require_once('blocks/header.php'); ?>
    <p>Hello <?php echo htmlspecialchars($name); ?>!</p>
    <ul>
        <?php foreach ($colors as $value): ?>
            <li><?php echo htmlspecialchars($value) ?>;</li>
        <?php endforeach; ?>
    </ul>
    <?php require_once('blocks/footer.php'); ?>
</body>
</html>