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
		View::render('dashboard.php', ['title' => 'camagru | My Dashboard']);
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
	 * settingsAction()
	 *
	 * The function changes firstname and lastname
	 *
	 * @return void
	 */
	public function settingsAction()
	{
		$args = array('title' => 'camagru | Settings');
		if (isset($_POST['submit'])) {
			if (isset($firstname)) {
				unset($firstname);
			}
			if (isset($lastname)) {
				unset($lastname);
			}
			$firstname = $this->checkFirstnameAndLastname($_POST['firstname']);
			$lastname = $this->checkFirstnameAndLastname($_POST['lastname']);
			if ($firstname !== false && $lastname !== false) {
				if (UserModel::changeFirstnameAndLastname($firstname, $lastname, $_SESSION['logged_user']['user_id'])) {
					$_SESSION['logged_user']['firstname'] = $firstname;
					$_SESSION['logged_user']['lastname'] = $lastname;
					$args['msg'] = 'Saved!';
				}
			} else {
				$args['firstname'] = $_POST['firstname'];
				$args['lastname'] = $_POST['lastname'];
				$args['e'] = 'Incorrect firstname or lastname. Name may only contain alphabetic characters.
								Length must be between 3 and 32 characters';
			}
			if ($_FILES['avatar']['name'] != '') {
				$dir = "uploads/" . $_SESSION['logged_user']['login'];
				if (!file_exists($dir)) {
					mkdir($dir);
				}
				if ($this->savePhoto($dir)) {
					$path_to_avatar = $this->getPathToAvatar($dir);
					if (UserModel::changeAvatar($path_to_avatar, $_SESSION['logged_user']['user_id'])) {
						$this->deletePhoto($_SESSION['logged_user']['avatar']);
						$_SESSION['logged_user']['avatar'] = $path_to_avatar;
					}
				}
			}
		}
		View::render('settings.php', $args);
	}

	public function removeAction()
	{
		$user_id = $_SESSION['logged_user']['user_id'];
		$this->logOutAction();
		UserModel::deleteUser($user_id);
		header('Location: /');
	}

	public function changePasswordAction()
	{
		$args = array('title' => 'camagru | Change Password');
		if (isset($_POST['submit'])) {
			$old_password = $_POST['old_password'];
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			$row = UserModel::getUserByLogin($_SESSION['logged_user']['login']);
			if ($this->checkPass($old_password) && password_verify($old_password, $row['password'])) {
				if ($this->checkPass($password1)) {
					if ($password1 == $password2) {
						$hash = password_hash($password1, PASSWORD_DEFAULT);
						if (UserModel::changePassword($hash, $_SESSION['logged_user']['user_id'])) {
							$args['msg'] = 'Your password was changed';
						}
					} else {
						$args['e'] = 'Passwords doesn\'t mutch!';
					}
				} else {
					$args['e'] = 'Password may only contain alphanumeric characters, underscores, at signs,
										dollar signs and dashes. Length must be between 8 and 32 characters';
				}
			} else {
				$args['e'] = 'Incorrect old password!';
			}
		}
		View::render('change-password.php', $args);
	}

	private function checkFirstnameAndLastname($name)
	{
		$pattern = '/^[A-Za-z]{3,32}$/';
		if (preg_match($pattern, $name)) {
			$name = ucwords(strtolower($name));
			return $name;
		}
		return false;
	}

	/**
	 * Save avatar to upload folder.
	 *
	 * @param $to
	 * @return bool
	 */
	private function savePhoto($to)
	{
		$ava_name = $this->getPathToAvatar($to);
		return (copy($_FILES['avatar']['tmp_name'], $ava_name));
	}

	private function deletePhoto($path)
	{
		if (strstr($path, $_SESSION['logged_user']['login'])) {
			unlink($path);
		}
	}

	/**
	 * Get full path to avatar.
	 *
	 * @param $dir
	 * @return string
	 */
	private function getPathToAvatar($dir)
	{
		return ($dir . "/" . time() . "." . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
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