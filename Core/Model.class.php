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
	/**
	 * getDB()
	 *
	 * Get the PDO database connection.
	 *
	 * @return null|PDO
	 */
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

	/**
	 * getUserById($user_id)
	 *
	 * This function get an user by `user_id` in DB's table.
	 *
	 * The return value of this function is a row as an array indexed by column name.
	 * Function returns false, if the user was not found
	 *
	 * Array
	 * (
	 *        [user_id] => 42
	 *        [firstname] => Kyrylo
	 *        [lastname] => Hrechenyiuk
	 *        [login] => petrovalida
	 *        [email] => lyrykua@gmail.com
	 *        [password] => $2y$10$D.XZmfUrX2mKbCTdQ5bS8OuJx4TjgwO7ExVShDm8FhiGwORAqDp0e
	 *        [active_hash] => $2y$10$D.XZmfUrX2mKbCTdQ5bS8OuJx4TjgwO7ExVShDm8FhiGwORAqDp0e
	 *        [status] => 1
	 *        [forgot_pass] => NULL
	 * )
	 *
	 * @param $user_id
	 * @return bool|mixed
	 */
	protected static function getUserById($user_id)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM `camagru`.`users`
			WHERE `user_id`=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $user_id);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return $row;
	}

	/**
	 * getUserByLogin($login)
	 *
	 * This function get an user by `login` in DB's table.
	 *
	 * The return value of this function is a row as an array indexed by column name.
	 * Function returns false, if the user was not found
	 *
	 * Array
	 * (
	 *        [user_id] => 42
	 *        [firstname] => Kyrylo
	 *        [lastname] => Hrechenyiuk
	 *        [login] => petrovalida
	 *        [email] => lyrykua@gmail.com
	 *        [password] => $2y$10$D.XZmfUrX2mKbCTdQ5bS8OuJx4TjgwO7ExVShDm8FhiGwORAqDp0e
	 *        [active_hash] => $2y$10$D.XZmfUrX2mKbCTdQ5bS8OuJx4TjgwO7ExVShDm8FhiGwORAqDp0e
	 *        [status] => 1
	 *        [forgot_pass] => NULL
	 * )
	 *
	 * @param $login
	 * @return bool|mixed
	 */
	public static function getUserByLogin($login)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM `camagru`.`users`
			WHERE `login`=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $login);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return $row;
	}

	/**
	 * getUserByEmail($email)
	 *
	 * This function get an user by `email` in DB's table.
	 *
	 * The return value of this function is a row as an array indexed by column name.
	 * Function returns false, if the user was not found
	 *
	 * Array
	 * (
	 *        [user_id] => 42
	 *        [firstname] => Kyrylo
	 *        [lastname] => Hrechenyiuk
	 *        [login] => petrovalida
	 *        [email] => lyrykua@gmail.com
	 *        [password] => $2y$10$D.XZmfUrX2mKbCTdQ5bS8OuJx4TjgwO7ExVShDm8FhiGwORAqDp0e
	 *        [active_hash] => $2y$10$D.XZmfUrX2mKbCTdQ5bS8OuJx4TjgwO7ExVShDm8FhiGwORAqDp0e
	 *        [status] => 1
	 *        [forgot_pass] => NULL
	 * )
	 *
	 * @param $email
	 * @return bool|mixed
	 */
	public static function getUserByEmail($email)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM `camagru`.`users`
			WHERE `email`=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $email);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return $row;
	}

	/**
	 * insertUser($login, $email, $password)
	 *
	 * This function add an user into `user` table.
	 *
	 * @param $login
	 * @param $email
	 * @param $password
	 */
	public static function insertUser($login, $email, $password)
	{
		try {
			$db = static::getDB();
			$sql = '
			INSERT INTO `camagru`.`users` (
				`login`, `email`, `password`)
			VALUES (
				:login, :email, :password);
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':login', $login);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}
}