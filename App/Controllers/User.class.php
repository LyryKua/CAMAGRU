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
	public function indexAction()
	{
		$users = UserModel::getAll();

		View::render('User/user.php', [
			'title' => 'camagru',
			'users' => $users
		]);
	}

	/**
	 * add new picture
	 *
	 * @return void
	 */
	public function addNewAction()
	{
		if (isset($_SESSION['user_id'])) {
			View::render('User/add_new.php', [
				'title' => 'camagru | Adding new photo'
			]);
		} else {
			header("Location: /");
		}
	}

	/**
	 * del an own picture
	 *
	 * @return void
	 */
	public function delAction()
	{
		echo "deleting new user";
	}

	/**
	 * like a picture
	 *
	 * @return void
	 */
	public function likeAction()
	{
		echo "user liked a photo";
	}
}