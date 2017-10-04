<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 12:33
 */

namespace App\Controllers;

use App\Models\NotificationsModel;
use App\Models\PhotoModel;
use App\Models\UserModel;
use App\Models\CommentModel;
use App\Models\LikeModel;
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
		$args = array('title' => 'camagru | My Dashboard');
		if (isset($_POST['comment']) && $_POST['comment'] != '') {
			$text = htmlspecialchars($_POST['comment']);
			CommentModel::insertComment($text, $_SESSION['logged_user']['user_id'], $_POST['photo_id']);
			header('Location: /' . $_SERVER['QUERY_STRING']);
			exit();
		}
		$args['posts'] = PhotoModel::countPhotosByUserID($_SESSION['logged_user']['user_id']);
		$photos = PhotoModel::getPhotosByUserID($_SESSION['logged_user']['user_id']);
		foreach ($photos as &$photo) {
			$photo['comments'] = PhotoModel::getCommentsToPhoto($photo['photo_id']);
		}
		$args['photos'] = $photos;
		if (isset($_SESSION['logged_user'])) {
			$args['like'] = LikeModel::getUserLike($_SESSION['logged_user']['user_id']);
		}
		View::render('dashboard.php', $args);
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
		$args = array('title' => 'camagru | Add Photo');
		if (isset($_POST['submit'])) {
			$dir = "uploads/" . $_SESSION['logged_user']['login'];
			$img = $dir . '/' . time() . ".png";
			if (!file_exists('uploads')){
				mkdir('uploads');
			}
			if (!file_exists($dir)) {
				mkdir($dir);
			}
			$base64 = $_POST['photo'];
			$data = explode(',', $base64);
			$photo = base64_decode($data[1]);
			file_put_contents($img, $photo);
			$source = imagecreatefrompng($img);
			imageflip($source, IMG_FLIP_HORIZONTAL);
			$frame = 'templates/frames/' . $_POST['frame'] . '.png';
			$frame = imagecreatefrompng($frame);
			imagecopyresized($source, $frame,
				0, 0,
				0, 0,
				imagesx($source), imagesy($source),
				imagesx($frame), imagesy($frame));
			imagejpeg($source, $img);
			PhotoModel::insertPhoto($img, $_SESSION['logged_user']['user_id']);
		}
		View::render('add-photo.php', $args);
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
				if (!file_exists('uploads')){
					mkdir('uploads');
				}
				if (!file_exists($dir)) {
					mkdir($dir);
				}
				if ($this->savePhoto($_FILES['avatar']['tmp_name'], $dir)) {
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

	public function notificationAction()
	{
		$args['title'] = 'camagru | Notification';
		if (isset($_POST['submit'])) {
			NotificationsModel::deleteNotificationForUser($_SESSION['logged_user']['user_id']);
		}
		$args['notification'] = NotificationsModel::getNotificationForUser($_SESSION['logged_user']['user_id']);
		View::render('notifications.php', $args);
	}

	public function deletePostAction()
	{
		if (isset($_POST['photo_id'])) {
			$path = PhotoModel::getPhotoByID($_POST['photo_id'])['path'];
			PhotoModel::deletePhoto($_POST['photo_id']);
			$this->deletePhoto($path);
			echo $path;
		} else {
			header('Location: /404');
		}
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
	private function savePhoto($photo, $to)
	{
		$ava_name = $this->getPathToAvatar($to);
		return (copy($photo, $ava_name));
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