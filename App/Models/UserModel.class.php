<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/28/17
 * Time: 12:30
 */

namespace App\Models;

use PDO;

/**
 * Class User
 *
 * @package App\Models
 *
 * User model
 */
class UserModel extends \Core\Model
{
	/**
	 * Get all the user from DB
	 *
	 * @return array
	 */
	public static function getAll()
	{
		try {
			$db = static::getDB();

			$query = 'SELECT * FROM `users`;';
			$stmt = $db->query($query);
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $results;
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function addUser($params)
	{
		try {
			$db = static::getDB();
			$sql = "INSERT INTO `camagru`.`users` (
						`name`, `surname`, `login`, `email`, `password`)
					VALUES (
				  		:firstname, :secondname, :login, :email, :password);";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':firstname', $params['firstname']);
			$stmt->bindParam(':secondname', $params['secondname']);
			$stmt->bindParam(':login', $params['login']);
			$stmt->bindParam(':email', $params['email']);
			$stmt->bindParam(':password', $params['password']);
			$stmt->execute();
			//
			$row = static::getUserByLogin($params['login']);
//			var_dump($row);
			$params['user_id'] = $row->user_id;
			self::sendMail($params);
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	/**
	 * sendMail()
	 *
	 * send mail to user
	 *
	 * @param array $param
	 */
	protected function sendMail($param)
	{
		$message = "
				<html lang='en'>
				<head>
					<title>Registration</title>
				</head>
				<body>
				<p>Hello, <b>" . $param['firstname'] . " " . $param['secondname'] . "</b> (@" . $param['login'] . ")!</p>
				<p>Help us secure your <a href='http://127.0.0.1:8080' title='camagru'>camagru</a> account by verifying your email
					address (" . $param['email'] . "). This lets you access all of camagru's features.</p>
				<p><a href='http://127.0.0.1:8080/wf/click?action=registration&id=" . $param['user_id'] . "&key=" . $param['active_hash'] . "'>Verify email address</a></p>
				<hr>
				<p>Button not working? Paste the following link into your browser:
					http://127.0.0.1:8080/wf/click?action=registration&id=" . $param['user_id'] . "&key=" . $param['active_hash'] . "</p>
				<p>You’re receiving this email because you recently created a new camagru account. If this wasn’t you, please ignore
					this email.</p>
				</body>
				</html>
			";
		$headers = "Content-type: text/html; charset=\"UTF-8\" \r\n";
		mail($param['email'], "Confirm your camagru account", $message, $headers);
	}

	public static function updateUserStatus($id, $status)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `users`
			SET `status`=?
			WHERE `user_id`=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $status);
			$stmt->bindParam(2, $id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}
}


//		UPDATE имя_таблицы SET имя_столбца=значение_столбца
//     WHERE условие;