<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 12:33
 */

namespace App\Controllers;

use App\Models\UserModel;
use \Core\View;

/**
 * Class User
 *
 * @package App\Controllers
 */
class User extends \Core\Controller
{
	/**
	 * indexAction()
	 *
	 * Show all photos an user.
	 *
	 * @return void
	 */
	public function indexAction()
	{
		View::render('dashboard.php');
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

	/**
	 * add new picture
	 *
	 * @return void
	 */
	public function addPhotoAction()
	{
		View::render('add-photo.php');
	}

	/**
	 * like a picture
	 *
	 * @return void
	 */
	public function settingsAction()
	{
		View::render('settings.php');
	}

	public function removeAction()
	{
		echo "delete user";
	}

	public function changePasswordAction()
	{
		View::render('change-password.php');
	}


	/**
	 * Before filter - called before an action method.
	 *
	 * @return void
	 */
	protected function before()
	{
		if (!isset($_SESSION['logged_user'])) {
			$args = array('title' => 'camagru | Sign Up');
			$args['e'] = 'You must Sign In before';
			View::render('log-in.php', $args);
			return false;
		}
		return true;
	}
}