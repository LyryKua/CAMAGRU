<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/settings.css">
	<link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">
</head>
<body>

<?php require_once('blocks/menu.php') ?>

<div class="form-container">
	<div class="form-header">
		<h2>settings</h2>
	</div>
	<form class="set" action="#" method="post" enctype=multipart/form-data>
		<?php if (isset($msg)) : ?>
			<div>
				<?php echo $msg; ?>
			</div>
		<?php endif ?>
		<label for="firstname">firstname</label>
		<br>
		<input type="text" id="firstname" name="firstname"
			   value="<?php echo (isset($firstname)) ? $firstname : $_SESSION['logged_user']['firstname']; ?>" required>
		<label for="lastname">lastname</label>
		<br>
		<input type="text" id="lastname" name="lastname"
			   value="<?php echo (isset($lastname)) ? $lastname : $_SESSION['logged_user']['lastname']; ?>" required>
		<label for="avatar">avatar</label>
		<br>
		<input type="file" id="avatar" name="avatar" accept="image/png; image/jpeg">
		<div>
			<a class="change-password" href="/user/change-password">Change Password</a>
		</div>
		<div>
			<a class="del_user" href="/user/remove">Remove Account</a>
		</div>
		<?php if (isset($e)) {
			echo "<div style='color: #ed4956; font-size: 1.3em; margin-bottom: 2px;'>" . $e . "</div>";
		} ?>
		<button type="submit" name="submit">save</button>
	</form>
</div>

</body>
</html>