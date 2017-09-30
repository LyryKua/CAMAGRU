<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/22/17
 * Time: 12:16
 */

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\LikeModel;
use App\Models\NotificationsModel;
use App\Models\PhotoModel;
use \Core\View;

/**
 * Class Home
 *
 * index()
 *
 *
 * @package App\Controllers
 */
class Post extends \Core\Controller
{
	/**
	 * this func shows list of all picture in DB
	 *
	 * @return void
	 */
	public function allAction()
	{
		$args = array('title' => 'camagru | All Photos');
		if (isset($_POST['comment']) && $_POST['comment'] != '') {
			$text = htmlspecialchars($_POST['comment']);
			CommentModel::insertComment($text, $_SESSION['logged_user']['user_id'], $_POST['photo_id']);
			$this->sendNotification(
				$_SESSION['logged_user']['user_id'],
				'comment',
				$_POST['photo_id']
			);
			header('Location: /' . $_SERVER['QUERY_STRING']);
			exit();
		}
		$photos = PhotoModel::getAllPhotos();
		foreach ($photos as &$photo) {
			$photo['comments'] = PhotoModel::getCommentsToPhoto($photo['photo_id']);
		}
		$args['photos'] = $photos;
		if (isset($_SESSION['logged_user'])) {
			$args['like'] = LikeModel::getUserLike($_SESSION['logged_user']['user_id']);
		}
//		var_dump($args['like']);
		View::render('index.php', $args);
	}

	/**
	 * show a single post
	 *
	 * @return void
	 */
	public function singleAction()
	{
		$args = array('title' => 'Photo');
		if (isset($_POST['comment']) && $_POST['comment'] != '') {
			$text = htmlspecialchars($_POST['comment']);
			CommentModel::insertComment($text, $_SESSION['logged_user']['user_id'], $_POST['photo_id']);
			$this->sendNotification(
				$_SESSION['logged_user']['user_id'],
				'comment',
				$_POST['photo_id']
			);
			header('Location: /' . $_SERVER['QUERY_STRING']);
			exit();
		}
		$args['photo_id'] = explode('/', $_SERVER['QUERY_STRING'])[1];
		$photo = PhotoModel::getPhotoByID($args['photo_id']);
		if ($photo !== false) {
			$photo['comments'] = PhotoModel::getCommentsToPhoto($args['photo_id']);
			$args['photo'] = $photo;
			if (isset($_SESSION['logged_user'])) {
				$args['like'] = LikeModel::getUserLike($_SESSION['logged_user']['user_id']);
			}
			View::render('single-post.php', $args);
		} else {
			View::render('404.php', $args);
		}
	}

	private function sendNotification($user_id, $text, $photo_id)
	{
		if ($text == 'comment') {
			NotificationsModel::insertNotification($user_id, ' commented your photo.', $photo_id);
		} elseif ($text == 'like') {
			NotificationsModel::insertNotification($user_id, ' liked your photo.', $photo_id);
		}
	}
}