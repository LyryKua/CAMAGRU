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

class Wf extends \Core\Controller
{
	public function clickAction()
	{
		if ($_GET['action'] == 'registration') {
			$this->confirmEmail($_GET['id'], $_GET['key']);
		}
	}

	protected function confirmEmail($id, $active_hash)
	{
		$arr = [
			'title' => 'camagru | All photos',
			'confirm' => false
		];
		$row = UserModel::getUserById($id);
		$tmp = $row->name . $row->surname . $row->login . $row->email;
		if ($row->status == '0' && password_verify($tmp, $active_hash)) {
			UserModel::updateUserStatus($id, 1);
			$arr['confirm'] = true;
		}
		View::render('Authorization/confirm_password.php', $arr);
	}
}
