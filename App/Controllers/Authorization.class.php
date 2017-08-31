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
				$arr['error'] = 'Login is incorrect!';
			} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$arr['error'] = 'Email is incorrect!';
			} else if (!AuthorizationModel::passwordValidation($password1, $password2)) {
				$arr['error'] = 'Passwords do not match!';
			} else {
				$query = "	INSERT INTO `camagru`.`users` (
								`name`, `surname`, `login`, `email`, `password`, `active_hash`)
					  		VALUES (
					  			:firstname, :secondname, :login, :email, :password, :active_hash);";
				$params['firstname'] = $name;
				$params['secondname'] = $surname;
				$params['login'] = $login;
				$params['email'] = $email;
				$params['password'] = password_hash($password1, PASSWORD_DEFAULT);
				$params['active_hash'] = password_hash($name . $surname . $login . $email, PASSWORD_DEFAULT);
				UserModel::addUser($query, $params);
			}
		}
		View::render('Authorization/sign-up.php', $arr);
	}

	/**
	 * This func sign-in an user
	 *
	 * @return void
	 */
	public
	function logInAction()
	{
		View::render('Authorization/log-in.php', [
			'title' => 'camagru | Log in'
		]);
	}

	/**
	 * This func sign-out an user
	 *
	 * @return void
	 */
	public
	function logOutAction()
	{
		echo "logOut";
	}
}

//abcdefghijklmnopqrstuvwxyz
//abcdefghijklmnop
//abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz