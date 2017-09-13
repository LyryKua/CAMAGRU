<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>camagru</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .form-container {
            max-width: 350px;
            margin: auto;
            position: relative;
            top: 142px;
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
            padding-left: 10px;
            padding-top: 20px;
            background-color: #f2f7e1;
            border-radius:0 0 6px 6px;
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
            margin-bottom: 20px;
            padding: 8px;
            border: 1px solid #82b4b1;
            border-radius: 3px;
            font-size: 1em;
            color: #82b4b1;
            width: 90%;
            background-color: transparent;
        }

        input:focus {
            outline: none;
            box-shadow: 0px 0px 50px 0px #82b4b1;
            background-color: white;
        }

        button {
            display: block;
            margin: auto;
            padding: 10px;
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
            padding: 5px 10px 15px 10px;
        }

    </style>
    <link rel="stylesheet" type="text/css" href="/css/blocks/header_for_log-in.css">
</head>
<body>
<!--<header class="top">-->
<!--    <div class="header">-->
<!--        <div class="content">-->
<!--            <div class="logo"><a href="/"><img src="/icons/logo2.png"></a></div>-->
<!--            <div class="user"><a href="/log-in"><img src="/icons/user3.png"></a></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->

<div class="form-container">
    <div class="form-header">
        <h2>Log In</h2>
    </div>
    <form action="#" method="post">
        <label for="login">Login</label>
        <br/>
        <input type="text" id="login" name="login">
        <br/>
        <label for="password">Password</label>
        <br/>
        <input type="password" id="password" name="password">
        <br/>
        <button type="submit">Log In</button>
        <br/>
        <p><a href="/reset-password">Forgot password?</a></p>
    </form>
    <p>Don't have an account? <a href="/sign-up">Sign up</a></p>
</div>
</body>
</html>