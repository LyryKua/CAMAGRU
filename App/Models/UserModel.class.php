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
						`name`, `surname`, `login`, `email`, `password`, `active_hash`)
					VALUES (
				  		:firstname, :secondname, :login, :email, :password, :active_hash);";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':firstname', $params['firstname']);
			$stmt->bindParam(':secondname', $params['secondname']);
			$stmt->bindParam(':login', $params['login']);
			$stmt->bindParam(':email', $params['email']);
			$stmt->bindParam(':password', $params['password']);
			$stmt->bindParam(':active_hash', $params['active_hash']);
			if ($stmt->execute()) {
				echo "Вставив!<br>";
			} else {
				echo "Мімо<br>";
			}// тут треба влипити іф для перевірки тру чи фолс
		} catch
		(\PDOException $e) {
			$e->getMessage();
		}
	}
}