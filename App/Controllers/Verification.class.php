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
		}
	}

	public function resetPassword()
	{
		View::render('reset-password2.php');
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
		var_dump($row);
		if ($active_hash != $row['active_hash']) {
			$args['e'] = 'Wrong key! Fuck you cheater';
		} elseif ((time() - strtotime($row['active_time'])) > 10800) {
			$args['e'] = 'You are late';
		} elseif ($row['status'] == '1') {
			$args['verification'] = 'Your account already activated';
		} else {
			if (UserModel::changeStatus($row['user_id'])) {
				$args['verification'] = 'Your email was verified';
			}
		}
		View::render('log-in.php', $args);
	}
}
