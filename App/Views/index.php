<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/styles/blocks/header.css">
    <link rel="stylesheet" type="text/css" href="/styles/blocks/footer.css">
    <link rel="stylesheet" type="text/css" href="/styles/html.css">
    <title>camagru</title>
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