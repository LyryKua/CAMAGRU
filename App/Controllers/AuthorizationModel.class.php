<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 11:36
 */

namespace App\Controllers;

/**
 * Class AuthorizationModel
 *
 * @package App\Controllers
 *
 * Відповідає за авторизацію, створення користувача та вихід
 */
class AuthorizationModel extends \Core\Controller
{
	/**
	 * This func sign-in an user
	 *
	 * @return void
	 */
	public function logInAction()
	{
		echo "ligIn";
	}

	/**
	 * This func create a new user
	 *
	 * @return void
	 */
	public function signUpAction()
	{
		echo "signUp";
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