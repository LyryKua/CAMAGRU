<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo (isset($title)) ? $title : "camagru"; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/blocks/header.css">
	<link rel="stylesheet" type="text/css" href="/css/log-in.css">
</head>
<body>

<?php require_once('blocks/header.php'); ?>

<div class="form-container">
	<div class="form-header">
		<h2>Sign In</h2>
	</div>
	<form action="/log-in" method="post">
		<?php if (isset($verification)) : ?>
			<div>
				<?php echo $verification; ?>
			</div>
		<?php endif ?>
		<label for="login">Login</label>
		<br>
		<input type="text" id="login" name="login"<?php if (isset($login)) {
			echo "value='" . $login . "'";
		} ?> required>
		<label for="password">Password</label>
		<br>
		<input type="password" id="password" name="password" required>
		<?php if (isset($e)) {
			echo "<div style='color: #ed4956; font-size: 1.3em; margin-bottom: 2px;'>" . $e . "</div>";
			if ($e == 'You must confirm your account!') {
				echo "
				<div style='text-align: center; color: rgba(130, 180, 177, 0.5); margin-bottom: 20px;'>
					<a href='/authorization/resend-letter'>Resend Letter</a>
				</div>
				";
			}
		} ?>
		<button type="submit" name="submit">Sign In</button>
		<div>
			<a href="/reset-password">Reset Password</a>
			|
			<a href="/sign-up">Sign Up</a>
		</div>
	</form>
</div>
</body>
</html>