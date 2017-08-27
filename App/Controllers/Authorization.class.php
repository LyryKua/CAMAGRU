<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 11:36
 */

namespace App\Controllers;
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
	 * This func sign-in an user
	 *
	 * @return void
	 */
	public function logInAction()
	{
		View::render('Authorization/log-in.php', [
			'title'		=>	'camagru | Log in'
		]);
	}

	/**
	 * This func create a new user
	 *
	 * @return void
	 */
	public function signUpAction()
	{
		View::render('Authorization/sign-up.php', [
			'title'		=>	'camagru | Sign up'
		]);
	}

	/**
	 * This func sign-out an user
	 *
	 * @return void
	 */
	public function logOutAction()
	{
		echo "logOut";
	}
}