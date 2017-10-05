<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 9/4/17
 * Time: 14:01
 */

namespace App\Controllers;

use App\Models\UserModel;
use Core;
use \Core\View;

class Verification extends \Core\Controller
{
	/**
	 * clickAction()
	 *
	 * Function get param `action` and call function (confirmEmail() or forgotPass())
	 *
	 * @return void
	 */
	public function clickAction()
	{
		if (isset($_GET['action']) && $_GET['action'] == 'registration') {
			$this->confirmEmail($_GET['user'], $_GET['key']);
		} elseif (isset($_GET['action']) && $_GET['action'] == 'reset') {
			$this->resetPassword($_GET['user'], $_GET['key']);
		}
	}

	public function resetPassword($email, $active_hash)
	{
		$row = UserModel::getUserByEmail($email);
		if ($active_hash != $row['active_hash']) {
			header('Location: /404');
		} elseif ((time() - strtotime($row['active_time'])) > 10800) {
			header('Location: /404');
		} else {
			$_SESSION['user_id'] = $row['user_id'];
			UserModel::delActiveHash($email);
			header('Location: /new-password');
		}

	}

	/**
	 * confirmEmail($email, $active_hash)
	 *
	 * The function confirms the new user. Check `active_hash`, `active_time` and `status`. Correct time is
	 * the diff between current time and `active_time`. It should be less than 3 hours.
	 *
	 * @param $email
	 * @param $active_hash
	 */
	public function confirmEmail($email, $active_hash)
	{
		$args = array('title' => 'camagru | Sign In');
		$row = UserModel::getUserByEmail($email);
		if ($active_hash != $row['active_hash']) {
			$args['e'] = 'Wrong key! Fuck you cheater';
		} elseif ($row['status'] == '1') {
			$args['verification'] = 'Your account already activated';
		} else {
			if (UserModel::changeStatus($row['user_id'])) {
				$args['verification'] = 'Your email was verified';
			}
		}
		View::render('log-in.php', $args);
	}

	public function newPasswordAction()
	{
		$file = 'reset-password2.php';
		$args = array('title' => 'camagru | Reset Password');
		if (isset($_POST['submit'])) {
			$password1 = htmlspecialchars(strtolower(trim($_POST['password1'])));
			$password2 = htmlspecialchars(strtolower(trim($_POST['password2'])));
			if (!$this->checkPass($password1)) {
				$args['e'] = 'Password may only contain alphanumeric characters, underscores, at signs, dollar signs
				and dashes. Length must be between 8 and 32 characters';
			} elseif ($password1 != $password2) {
				$args['e'] = 'These passwords don\'t match';
			} else {
				$pass = password_hash($password1, PASSWORD_DEFAULT);
				UserModel::changePassword($pass, $_SESSION['user_id']);
				$file = 'log-in.php';
				$args['e'] = 'Password changed!';
			}
		}
		View::render($file, $args);
	}
}
