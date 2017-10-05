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
		$file = 'sign-up.php';
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
				$file = 'log-in.php';
				$args['e'] = 'Check your email. We sent you a letter';
			} else {
				$args['e'] = $e;
			}
		}
		View::render($file, $args);
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
				if ($row !== false) {
					if (password_verify($pass, $row['password'])) {
						if ($row['status'] == '1') {
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
							$args['e'] = 'You must confirm your account!';
							$_SESSION['login'] = $row['login'];
							$_SESSION['email'] = $row['email'];
						}
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
	 * resendLetterAction()
	 *
	 * The function resend letter if user forgot confirm him account.
	 */
	public function resendLetterAction()
	{
		$args = array('title' => 'camagru | Sign In');
		$login = $_SESSION['login'];
		$email = $_SESSION['email'];
		$active_hash = hash('md5', uniqid(rand(), true));
		if (UserModel::setActiveHash($login, $active_hash)) {
			$this->sendRegMail($email, $login, $active_hash);
			header('Location: /log-in');
		}
		View::render('log-in.php', $args);
	}

	/**
	 * resetPasswordAction()
	 *
	 * The function take login and send mail for reset password.
	 */
	public function resetPasswordAction()
	{
		$args = array('title' => 'camagru | Reset Password');
		if (isset($_POST['submit'])) {
			$login = htmlspecialchars(strtolower(trim($_POST['login'])));
			$args['login'] = $login;
			if ($this->checkLogin($login)) {
				$row = UserModel::getUserByLogin($login);
				if ($row !== false) {
					$active_hash = hash('md5', uniqid(rand(), true));
					if (UserModel::setActiveHash($login, $active_hash)) {
						$email = UserModel::getUserByLogin($login)['email'];
						$this->sendResetMail($email, $active_hash);
						$args['e'] = 'Check your email. We sent you a letter';
					}
				} else {
					$args['e'] = 'Login does not exist!';
				}
			} else {
				$args['e'] = 'Wrong login!';
			}
		}
		View::render('reset-password1.php', $args);
	}

	/**
	 * checkParams($login, $email, $pass1, $pass2)
	 *
	 * The function checks params from sign up form. Func returns TRUE if all is OK. If
	 * something wrong function returns error string (example: 'Login is already taken').
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
			$e = 'Login may only contain alphanumeric characters and underscores. Length must be
						between 3 and 16 characters';
		} elseif (UserModel::getUserByLogin($login) !== false) {
			$e = 'Login is already taken';
		} elseif (UserModel::getUserByEmail($email) !== false) {
			$e = 'Email is already taken';
		} elseif (!$this->checkPass($pass1)) {
			$e = 'Password may only contain alphanumeric characters, underscores, at signs, dollar signs and dashes.
						Length must be between 8 and 32 characters';
		} elseif ($pass1 != $pass2) {
			$e = 'These passwords don\'t match';
		}
		return $e;
	}

	/**
	 * checkLogin($login)
	 *
	 * Login may only contain alphanumeric characters and underscores. Length must be
	 * between 3 and 16 characters.
	 * Function returns TRUE if the user has entered the correct login.
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
				<p>Help us secure your <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "' title='camagru'>camagru</a> account by verifying your email
					address (" . $email . "). This lets you access all of camagru's features.</p>
				<p><a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/verification/click?action=registration&user=" . $email . "&key=" . $active_hash . "'>Verify email address</a></p>
				<hr>
				<p>Button not working? Paste the following link into your browser:
						" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/verification/click?action=registration&user=" . $email . "&key=" . $active_hash . "</p>
				<p>You’re receiving this email because you recently created a new camagru account. If this wasn’t you, please ignore
					this email.</p>
				</body>
				</html>
			";
		$headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
		$headers .= "From: camagru <lyryk.ua@gmail.com> \r";
		mail($email, "[camagru] Confirm your account", $message, $headers);
	}

	private function sendResetMail($email, $active_hash)
	{
		$message = "
				<html lang='en'>
				<head>
					<title>Reset Password</title>
				</head>
				<body>
				<p>We heard that you lost your camagru password. Sorry about that! But don’t worry! You can use the
				following link within the next day to reset your password:
						" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/verification/click?action=reset&user=" . $email . "&key=" . $active_hash . "</p>
				<p>If you don’t use this link within 3 hours, it will expire. To get a new password reset link, visit" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/reset-password</p>
				<p>Thanks, Your friends at camagru</p>
				</body>
				</html>
			";
		$headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
		$headers .= "From: camagru <lyryk.ua@gmail.com> \r";
		mail($email, "[camagru] Reset password", $message, $headers);
	}

	/**
	 * Before filter - called before an action method.
	 *
	 * @return void
	 */
	protected function before()
	{
		if (isset($_SESSION['logged_user'])) {
			header('Location: /user');
			return false;
		}
		return true;
	}
}