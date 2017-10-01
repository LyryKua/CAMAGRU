<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/change-password.css">
</head>
<body>

<?php require_once('blocks/menu.php') ?>

<div class="form-container">
	<div class="form-header">
		<h2>Change Password</h2>
	</div>
	<form action="#" method="post">
		<?php if (isset($msg)) : ?>
			<div>
				<?php echo $msg; ?>
			</div>
		<?php endif ?>
		<label for="old_password">old password</label>
		<br>
		<input type="password" id="old_password" name="old_password">
		<label for="password1">new password</label>
		<br>
		<input type="password" id="password1" name="password1">
		<label for="password2">confirm password</label>
		<br>
		<input type="password" id="password2" name="password2">
		<?php if (isset($e)) {
			echo "<div style='color: #ed4956; font-size: 1.3em; margin-bottom: 2px;'>" . $e . "</div>";
		} ?>
		<button type="submit" name="submit">change password</button>
	</form>
</div>
</body>
</html>