<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 11:36
 */

namespace App\Controllers;

use App\Models\LikeModel;
use App\Models\NotificationsModel;
use App\Models\PhotoModel;
use App\Models\UserModel;
use Core\View;
use Core\Model;

/**
 * Class Authorization
 * @package App\Controllers
 */
class Like extends \Core\Controller
{
	public function setLikeAction()
	{
		if (LikeModel::index($_SESSION['logged_user']['user_id'], $_POST['photo_id']) === true) {
			PhotoModel::like($_POST['photo_id']);
			NotificationsModel::insertNotification(
				$_SESSION['logged_user']['user_id'],
				' liked your photo.',
				$_POST['photo_id']);
		} elseif (LikeModel::index($_SESSION['logged_user']['user_id'], $_POST['photo_id']) === false) {
			LikeModel::delItem($_SESSION['logged_user']['user_id'], $_POST['photo_id']);
			PhotoModel::dislike($_POST['photo_id']);
			NotificationsModel::deleteNotification(
				$_SESSION['logged_user']['user_id'],
				' liked your photo.',
				$_POST['photo_id']);
		}
		echo PhotoModel::getPhotoByID($_POST['photo_id'])['likes'];
	}
}