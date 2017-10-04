<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/22/17
 * Time: 13:28
 */

namespace Core;

use App\Models\CommentModel;
use App\Models\NotificationsModel;

/**
 * Class Controller
 *
 * @package Core
 */
abstract class Controller
{
	/**
	 * Parameters from the matched route
	 *
	 * @var array
	 */
	protected $route_params = [];

	/**
	 * Controller constructor.
	 *
	 * Function fills $route_params from the route
	 *
	 * @param array $route_params Parameters from the route
	 */
	public function __construct($route_params)
	{
		$this->route_params = $route_params;
	}

	/**
	 * Magic method called when a non-existent or inaccessible method is
	 * called on an object of this class. Used to execute before and after
	 * filter methods on action methods. Action methods need to be named
	 * with an "Action" suffix, e.g. indexAction, showAction etc.
	 *
	 * @param string $name  Method name
	 * @param array $arguments Arguments passed to the method
	 *
	 * @return void
	 */
	public function __call($name, $arguments)
	{
		$method = $name . "Action";

		if (method_exists($this, $method)) {
			if ($this->before() !== false) {
				call_user_func_array([$this, $method], $arguments);
				$this->after();
			}
		} else {
//			throw new \Exception("Method $method not found in controller " . get_class($this));
			header('Location: /404');
			exit();
//			echo "Method $method not found in controller " . get_class($this);
		}
	}

	/**
	 * checkPass($pass)
	 *
	 * Password may only contain alphanumeric characters, underscores, at signs, dollar
	 * signs and dashes. Function returns TRUE if the user has entered the correct login.
	 * Length must be between 8 and 32 characters.
	 * Function returns TRUE if the user has entered the correct password.
	 *
	 * @param $pass
	 * @return bool
	 */
	protected function checkPass($pass)
	{
		$pattern = '/^[\w@$-]{8,32}$/';
		if (preg_match($pattern, $pass)) {
			return true;
		}
		return false;
	}

	protected function addComment($comment, $photo_id)
	{
		$text = htmlspecialchars($comment);
		CommentModel::insertComment($text, $_SESSION['logged_user']['user_id'], $photo_id);
		$this->sendNotification(
			$_SESSION['logged_user']['user_id'],
			'comment',
			$photo_id
		);
		$to = NotificationsModel::getEmailForNotification($_POST['photo_id'])['email'];
		$this->sendNotificationToEmail($to, ' commented your photo.', $_SESSION['logged_user']['login']);
		header('Location: /' . $_SERVER['QUERY_STRING']);
		exit();
	}

	protected function sendNotification($user_id, $text, $photo_id)
	{
		$to = NotificationsModel::getEmailForNotification($photo_id)['email'];
		var_dump($to);
		if ($text == 'comment') {
			NotificationsModel::insertNotification($user_id, ' commented your photo.', $photo_id);
			$this->sendNotificationToEmail($to['email'], ' commented your photo.', $_SESSION['logged_user']['login']);
		} elseif ($text == 'like') {
			NotificationsModel::insertNotification($user_id, ' liked your photo.', $photo_id);
			$this->sendNotificationToEmail($to['email'], ' liked your photo.', $_SESSION['logged_user']['login']);
		}
	}

	protected function sendNotificationToEmail($to, $text, $who)
	{
		$who .= $text;
		$message = "
				<html lang='en'>
				<head>
					<title>Notification</title>
				</head>
				<body>
				<h1>$who</h1>
				</body>
				</html>
			";
		$headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
		$headers .= "From: camagru <lyryk.ua@gmail.com> \r";
		mail($to, 'Notification', $message, $headers);
	}

	/**
	 * Before filter - called before an action method.
	 *
	 * @return void
	 */
	protected function before()
	{
	}

	/**
	 * After filter - called after an action method.
	 *
	 * @return void
	 */
	protected function after()
	{
	}
}