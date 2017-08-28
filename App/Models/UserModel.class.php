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

			$query = 'SELECT * FROM `users`';
			$stmt = $db->query($query);
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $results;
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}