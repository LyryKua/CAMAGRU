<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 11:36
 */

namespace App\Controllers;

use App\Models\AuthorizationModel;
use App\Models\UserModel;
use Core\View;

/**
 * Class Authorization
 *
 * @package App\Controllers
 *
 * Відповідає за авторизацію, створення користувача та вихід
 */
class Authorization extends \Core\Controller
{
	/**
	 * Функція створює нового коритсувача (реєстрація).
	 *
	 * Потрібно перевірити чи варто використовувати функцію htmlspecialchars()?
	 *
	 * @return void
	 */
	public function signUpAction()
	{
		if (!isset($_SESSION['user_id'])) {
			$arr = ['title' => 'camagru | Sign up'];
			if (isset($_POST['submit'])) {
				$name = ucfirst(strtolower(htmlspecialchars($_POST['name'])));
				$surname = ucfirst(strtolower(htmlspecialchars($_POST['surname'])));
				$login = strtolower(htmlspecialchars($_POST['login']));
				$email = strtolower(htmlspecialchars($_POST['email']));
				$password1 = htmlspecialchars($_POST['password1']);
				$password2 = htmlspecialchars($_POST['password2']);
				if (!AuthorizationModel::nameValidation($name)) {
					$arr['error'] = 'Name is incorrect!';
				} else if (!AuthorizationModel::surnameValidation($surname)) {
					$arr['error'] = 'Surname is incorrect!';
				} else if (!AuthorizationModel::loginValidation($login)) {
					$arr['error'] = 'Login is incorrect or this login is already taken!';
				} else if (!AuthorizationModel::emailValidation($email)) {
					$arr['error'] = 'Email is already taken!';
				} else if (!AuthorizationModel::passwordValidation($password1, $password2)) {
					$arr['error'] = 'Passwords are incorrect!';
				} else {
					$params['firstname'] = $name;
					$params['secondname'] = $surname;
					$params['login'] = $login;
					$params['email'] = $email;
					$params['password'] = password_hash($password1, PASSWORD_DEFAULT);
					$params['active_hash'] = password_hash($name . $surname . $login . $email, PASSWORD_DEFAULT);
					UserModel::addUser($params);
				}
			}
			View::render('Authorization/sign-up.php', $arr);
		} else {
			header("Location: /");
		}
	}

	/**
	 * This func sign-in an user
	 *
	 * @return void
	 */
	public function logInAction()
	{
		if (!isset($_SESSION['user_id'])) {
			$arr = ['title' => 'camagru | Log in'];
			if (isset($_POST['submit'])) {
				$login = strtolower(htmlspecialchars($_POST['login']));
				$password = htmlspecialchars($_POST['password']);
				$row = AuthorizationModel::checkUserInDb($login);
				if (!$row) {
					$arr['error'] = 'Login is incorrect!';
				} else {
					if (password_verify($password, $row->password)) {
						$_SESSION['user_id'] = $row->user_id;
						header("Location: /");
					} else {
						$arr['error'] = 'Wrong Password!';
					}
				}
			}
			View::render('Authorization/log-in.php', $arr);
		} else {
			header("Location: /");
		}
	}

	/**
	 * This func sign-out an user
	 *
	 * @return void
	 */
	public
	function logOutAction()
	{
		if (isset($_SESSION['user_id'])) {
			unset($_SESSION['user_id']);
		}
		header("Location: /");
	}

	public function resetPasswordAction()
	{
		if (!isset($_SESSION['user_id'])) {
			$arr = ['title' => 'camagru | Reset Password'];
			if (isset($_POST['submit'])) {
				$value = $_POST['value'];
				if (strstr($value, '@')) {
					if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
						$row = UserModel::resetPassword($value);
						if (!$row) {
							$arr['error'] = 'Email didn\'t find!';
						} else {
							UserModel::sendResetPass($row);
						}
					} else {
						$arr['error'] = 'Email is incorrect!';
					}
				} else {
					$row = UserModel::resetPassword($value);
					if (!$row) {
						$arr['error'] = 'Login didn\'t find!';
					} else {
						UserModel::sendResetPass($row);
					}
				}

			}
			View::render('Authorization/reset_password.php', $arr);
		} else {
			header("Location: /");
		}
	}
}