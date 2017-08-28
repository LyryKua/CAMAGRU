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
class UserModel
{
	/**
	 * Get all the user from DB
	 *
	 * @return array
	 */
	public static function getAll()
	{
		$host = "localhost";
		$db_name = "camagru";
		$user = "root";
		$password = "256512";

		try {
			$db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8",
				$user, $password);

			$query = 'SELECT * FROM `users`';
			$stmt = $db->query($query);
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $results;
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}