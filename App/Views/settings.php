<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<style>
		body {
			padding: 0;
			margin: 0;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
		}

		.form-container {
			max-width: 350px;
			margin: auto;
			position: relative;
			top: 280px;
			border: 1px solid #82b4b1;
			border-radius: 6px;
		}

		.form-header {
			background-color: #e0f2ed;
			border-radius: 6px 6px 0 0;
			border-bottom: 1px solid #82b4b1;
		}

		h2 {
			margin: 0;
			text-transform: uppercase;
			color: #82b4b1;
			font-weight: 600;
			letter-spacing: 1px;
			font-size: 1.9em;
			line-height: 1.8em;
			text-align: center;
		}

		form.set {
			position: relative;
			padding: 20px 10px 2px;
			background-color: #f2f7e1;
			border-radius: 0 0 6px 6px;
		}

		form.set label {
			text-transform: lowercase;
			color: #82b4b1;
			font-weight: 600;
			letter-spacing: 1px;
			font-size: .9em;
			line-height: 2em;
		}

		form.set input {
			padding: 8px;
			border: 1px solid #82b4b1;
			border-radius: 3px;
			font-size: 1em;
			color: #82b4b1;
			display: block;
			margin: 0 auto 20px;
			width: 90%;
			background-color: transparent;
		}

		form.set input[type="file"] {
			opacity: 0;
			position: absolute;
			cursor: pointer;
			z-index: 0;
		}

		div.choose {
			display: flex;
			border: 1px solid #82b4b1;
			height: 32px;
			border-radius: 3px;
			width: 95%;
			margin: 0 auto;
		}

		div.choose > span {
			margin: auto;
			color: #82b4b1;
		}

		div.path {
			font-size: 0.7em;
			margin: 0 auto 20px;
			color: #82b4b1;
		}

		form.set input:focus {
			outline: none;
			box-shadow: 0px 0px 50px 0px #82b4b1;
			background-color: white;
			border: 1px solid #87d1d0;
		}

		form.set button {
			display: block;
			margin: auto auto 10px;
			padding: 10px 20px;
			border: 0;
			border-radius: 3px;
			color: #82b4b1;
			background-color: #e0f2ed;
			text-transform: uppercase;
			font-weight: 600;
			outline: none;
			letter-spacing: 1px;
			font-size: 0.9em;
			cursor: pointer;
		}

		form.set button:hover {
			/*border-bottom: 6px solid #e0f2ed;*/
			transition: 0.5s all;
			color: #e0f2ed;
			background-color: #82b4b1;
		}

		form.set > div {
			text-align: center;
			color: rgba(130, 180, 177, 0.5);
		}

		form.set a {
			display: inline-block;
			text-decoration: none;
			font-size: 0.7em;
			color: rgba(130, 180, 177, 0.5);
			text-align: center;
		}

		form.set a:hover {
			color: #82b4b1;
			transition: 0.5s all;
		}

		form.set a.change-password {
			display: inline-block;
			text-decoration: none;
			font-size: 1em;
			color: rgba(130, 180, 177, 0.5);
			text-align: center;
			margin-bottom: 20px;
		}

		form.set a.change-password:hover {
			color: #82b4b1;
			transition: 0.5s all;
		}

		form.set a.del_user {
			display: inline-block;
			text-decoration: none;
			font-size: 1em;
			color: rgba(237, 73, 86, 0.5);
			text-align: center;
			margin-bottom: 20px;
		}

		form.set a.del_user:hover {
			color: #ed4956;
			transition: 0.5s all;
		}

		form.set p {
			margin-top: 15px;
			margin-bottom: 2px;
		}

		a {
			text-decoration: none;
		}

	</style>
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
			   value="<?php echo (isset($firstname)) ? $firstname : $_SESSION['logged_user']['firstname']; ?>">
		<label for="lastname">lastname</label>
		<br>
		<input type="text" id="lastname" name="lastname"
			   value="<?php echo (isset($lastname)) ? $lastname : $_SESSION['logged_user']['lastname']; ?>">
		<label for="avatar">avatar</label>
		<br>
		<input type="file" id="avatar" name="avatar" accept="image/png; image/jpeg">
		<div class="choose">
			<span>Update Profile Picture</span>
		</div>
		<div class="path">
			path/to/file.jpg
		</div>
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