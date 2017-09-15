<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 11:36
 */

namespace App\Controllers;

use App\Models\UserModel;
use Core\View;
use Core\Model;

/**
 * Class Authorization
 * @package App\Controllers
 */
class Authorization extends \Core\Controller
{
	/**
	 * signUpAction()
	 *
	 * This function registers new user.
	 *
	 * @return void
	 */
	public function signUpAction()
	{
		$args = array('title' => 'camagru | Sign Up');
		if (isset($_POST['submit'])) {
			$login = htmlspecialchars(strtolower(trim($_POST['login'])));
			$email = htmlspecialchars(strtolower(trim($_POST['email'])));
			$pass1 = htmlspecialchars($_POST['pass1']);
			$pass2 = htmlspecialchars($_POST['pass2']);
			$args['login'] = $login;
			$args['email'] = $email;
			$e = $this->checkSignUpParam($login, $email, $pass1, $pass2);
			if ($e === true) {
				$password = password_hash($pass1, PASSWORD_DEFAULT);
				UserModel::insertUser($login, $email, $password);
				$active_hash = hash('md5', uniqid(rand(), true));
				if (UserModel::setActiveHash($login, $active_hash)) {
					$this->sendRegMail($email, $login, $active_hash);
				}
			} else {
				$args['e'] = $e;
			}
		}
		View::render('sign-up.php', $args);
	}

	/**
	 * This func sign-in an user
	 *
	 * @return void
	 */
	public function logInAction()
	{
		$args = array('title' => 'camagru | Sign In');
		if (isset($_POST['submit'])) {
			$login = htmlspecialchars(strtolower(trim($_POST['login'])));
			$pass = htmlspecialchars($_POST['password']);
			$args['login'] = $login;
			if ($login != '' && $this->checkLogin($login) && $pass != '') {
				$row = UserModel::getUserByLogin($login);
				var_dump($row);
				if ($row !== false) {
					if (password_verify($pass, $row['password'])) {
						$_SESSION['logged_user'] = array(
							'user_id' => $row['user_id'],
							'login' => $row['login'],
							'email' => $row['email'],
							'firstname' => $row['firstname'],
							'lastname' => $row['lastname'],
							'avatar' => $row['avatar']
						);
						header('Location: /user');
					} else {
						$args['e'] = 'Incorrect username or password';
					}
				} else {
					$args['e'] = 'Incorrect username or password';
				}
			} else {
				$args['e'] = 'Incorrect username or password';
			}
		}
		View::render('log-in.php', $args);
	}

	/**
	 * This func sign-out an user
	 *
	 * @return void
	 */
	public function logOutAction()
	{
		unset($_SESSION['logged_user']);
		header('Location: /');
	}

	public function resetPasswordAction()
	{
		View::render('reset-password1.php');
	}

	/**
	 * checkParams($login, $email, $pass1, $pass2)
	 *
	 * The function checks params from sign up form. Func returns TRUE if all is OK. If
	 * something wrong function returns error string (Example: 'Login is already taken').
	 *
	 * @param $login
	 * @param $email
	 * @param $pass1
	 * @param $pass2
	 * @return bool|string
	 */
	private function checkSignUpParam($login, $email, $pass1, $pass2)
	{
		$e = true;
		if (!$this->checkLogin($login)) {
			$e = 'Login may only contain alphanumeric characters and underscores. Maximum length is 16 characters';
		} elseif (UserModel::getUserByLogin($login) !== false) {
			$e = 'Login is already taken';
		} elseif (UserModel::getUserByEmail($email) !== false) {
			$e = 'Email is already taken';
		} elseif ($pass1 !== $pass2) {
			$e = 'These passwords don\'t match';
		}
		return $e;
	}

//	private function checkLogInParam($login, $pass)
//	{
//		$e = true;
//		if ($login == '' && $this->checkLogin($login) && $pass == '') {
//
//		} elseif (UserModel::getUserByLogin($login) !== false) {
//			$e = 'Login is already taken';
//		} elseif (UserModel::getUserByEmail($email) !== false) {
//			$e = 'Email is already taken';
//		} elseif ($pass1 !== $pass2) {
//			$e = 'These passwords don\'t match';
//		}
//		return $e;
//	}

	/**
	 * checkLogin($login)
	 *
	 * Login may only contain alphanumeric characters and underscores. Function returns TRUE if the user
	 * has entered the correct login.
	 *
	 * @param $login
	 * @return bool
	 */
	private function checkLogin($login)
	{
		$pattern = '/^[a-z0-9_]{3,16}$/';
		if (preg_match($pattern, $login)) {
			return true;
		}
		return false;
	}

	/**
	 * sendRegMail($email, $login, $active_hash)
	 *
	 * The function sends mail to $email after the new user registered.
	 *
	 * @param $email
	 * @param $login
	 * @param $active_hash
	 */
	private function sendRegMail($email, $login, $active_hash)
	{
		$message = "
				<html lang='en'>
				<head>
					<title>Registration</title>
				</head>
				<body>
				<p>Hello, <b>@" . $login . "</b>!</p>
				<p>Help us secure your <a href='" . $_SERVER['SERVER_NAME'] . "' title='camagru'>camagru</a> account by verifying your email
					address (" . $email . "). This lets you access all of camagru's features.</p>
				<p><a href='http://localhost:8080/verification/click?action=registration&user=" . $email . "&key=" . $active_hash . "'>Verify email address</a></p>
				<hr>
				<p>Button not working? Paste the following link into your browser:
						http://localhost:8080/verification/click?action=registration&user=" . $email . "&key=" . $active_hash . "</p>
				<p>You’re receiving this email because you recently created a new camagru account. If this wasn’t you, please ignore
					this email.</p>
				</body>
				</html>
			";
		$headers = "Content-type: text/html; charset=\"UTF-8\" \r\n";
		mail($email, "[camagru] Confirm your account", $message, $headers);

	}
}