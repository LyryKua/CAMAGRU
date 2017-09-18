<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title><?php echo $title; ?></title>

    <link rel="stylesheet" type="text/css" href="/css/blocks/menu.css">

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
            top: 290px;
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

        form {
            padding: 20px 10px 2px;
            background-color: #f2f7e1;
            border-radius: 0 0 6px 6px;
        }

        label {
            text-transform: lowercase;
            color: #82b4b1;
            font-weight: 600;
            letter-spacing: 1px;
            font-size: .9em;
            line-height: 2em;
        }

        input {
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

        input:focus {
            outline: none;
            box-shadow: 0px 0px 50px 0px #82b4b1;
            background-color: white;
            border: 1px solid #87d1d0;
        }

        button {
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

        button:hover {
            /*border-bottom: 6px solid #e0f2ed;*/
            transition: 0.5s all;
            color: #e0f2ed;
            background-color: #82b4b1;
        }

        form > div {
            text-align: center;
            color: rgba(130, 180, 177, 0.5);
        }

        form a {
            display: inline-block;
            text-decoration: none;
            font-size: 0.7em;
            color: rgba(130, 180, 177, 0.5);
            text-align: center;
        }

        form a:hover {
            color: #82b4b1;
            transition: 0.5s all;
        }

        form p {
            margin-top: 15px;
            margin-bottom: 2px;
        }

    </style>

</head>
<body>

<?php require_once('blocks/menu.php') ?>

<div class="form-container">
    <div class="form-header">
        <h2>Change Password</h2>
    </div>
    <form action="#" method="post">
        <label for="old_password">old password</label>
        <br>
        <input type="password" id="old_password" name="old_password">
        <label for="password1">new password</label>
        <br>
        <input type="password" id="password1" name="password1">
        <label for="password2">confirm password</label>
        <br>
        <input type="password" id="password2" name="password2">
        <button type="submit">change password</button>
        <div>
            <a href="/log-in">Sign In</a>
            |
            <a href="/sign-up">Sign Up</a>
        </div>
    </form>
</div>
</body>
</html>