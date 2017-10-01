<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="/css/reset-password1.css">
	<link rel="stylesheet" type="text/css" href="/css/blocks/header.css">
</head>
<body>
<header class="top">
	<div class="header">
		<div class="content">
			<div class="logo"><a href="/"><img src="/icons/logo2.png"></a></div>
			<div class="user"><a href="/log-in"><img src="/icons/user3.png"></a></div>
		</div>
	</div>
</header>

<div class="form-container">
	<div class="form-header">
		<h2>reset password</h2>
	</div>
	<form action="#" method="post">
		<label for="login">Login</label>
		<br>
		<input type="text" id="login" name="login"<?php if (isset($login)) {
			echo "value='" . $login . "'";
		} ?> required>
		<?php if (isset($e)) {
			echo "<div style='color: #ed4956; font-size: 1.3em; margin-bottom: 5px;'>" . $e . "</div>";
		} ?>
		<button type="submit" name="submit">confirm</button>
		<div>
			<a href="/log-in">Sign In</a>
			|
			<a href="/sign-up">Sign Up</a>
		</div>
	</form>
</div>
</body>
</html>