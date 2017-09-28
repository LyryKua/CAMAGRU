<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/22/17
 * Time: 12:16
 */

namespace App\Controllers;

use App\Models\CommentModel;
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
			header('Location: /' . $_SERVER['QUERY_STRING']);
			exit();
		}
		$photos = PhotoModel::getAllPhotos();
		foreach ($photos as &$photo) {
			$photo['comments'] = PhotoModel::getCommentsToPhoto($photo['photo_id']);
		}
		$args['photos'] = $photos;
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
			header('Location: /' . $_SERVER['QUERY_STRING']);
			exit();
		}
		$args['photo_id'] = explode('/', $_SERVER['QUERY_STRING'])[1];
		$photo = PhotoModel::getPhotoByID($args['photo_id']);
		$photo['comments'] = PhotoModel::getCommentsToPhoto($args['photo_id']);
		$args['photo'] = $photo;
		View::render('single-post.php', $args);
	}
}