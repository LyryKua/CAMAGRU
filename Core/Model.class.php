<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/28/17
 * Time: 14:59
 */

namespace Core;

use PDO;
use App\Configuration;

/**
 * Class Model
 *
 * @package Core
 */
abstract class Model
{
	protected static function getDB()
	{
		static $db = null;
		if ($db === null) {
			try {
				$dsn = "mysql:host=" . Configuration::DB_HOST . ";dbname=" . Configuration::DB_NAME . ";charset=utf8";
				$db = new PDO($dsn, Configuration::DB_USER, Configuration::DB_PASSWORD);
			} catch (\PDOException $e) {
				echo $e->getMessage();
			}
		}
		return $db;
	}

	protected static function getUserByLogin($login)
	{
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM camagru.users
			WHERE login=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $login);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_OBJ);
			return $row;
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	public static function getUserById($id)
	{
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM camagru.users
			WHERE user_id=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_OBJ);
			return $row;
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}
}