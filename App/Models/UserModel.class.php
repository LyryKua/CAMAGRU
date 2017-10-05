<?php

/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 9/14/17
 * Time: 14:41
 */

namespace App\Models;

use PDO;

class UserModel extends \Core\Model
{
	/**
	 * updateActiveHash($login, $active_hash)
	 *
	 * This function updates `active_hash` every time when user forgot password or create new account. Also this
	 * this function set current time in `forgot_pass`.
	 *
	 * @param $login
	 * @param $active_hash
	 *
	 * @return bool
	 */
	public static function setActiveHash($login, $active_hash)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `camagru`.`users`
			SET `active_hash`=:active_hash, `active_time`=CURRENT_TIMESTAMP
			WHERE `login`=:login;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':active_hash', $active_hash);
			$stmt->bindParam(':login', $login);
			if ($stmt->execute()) {
				return true;
			}
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return false;
	}

	/**
	 * changeStatus($user_id)
	 *
	 * Function sets value `status` in 1. Also removes `active_hash` and `active_time`. Value of this params
	 * will be 'null'.
	 *
	 * @param $user_id
	 * @return bool
	 */
	public static function changeStatus($user_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `camagru`.`users`
			SET `status`=TRUE, `active_hash`=NULL, `active_time`=NULL 
			WHERE `users`.`user_id`=:user_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			if ($stmt->execute()) {
				return true;
			}
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return false;
	}

	/**
	 * changeFirstnameAndLastname($firstname, $lastname, $user_id)
	 *
	 * Func sets value `firstname` and `lastname` in $firstname and $lastname. This func returns true if params
	 * changed. And false if didn't
	 *
	 * @param $firstname
	 * @param $lastname
	 * @param $user_id
	 * @return bool
	 */
	public static function changeFirstnameAndLastname($firstname, $lastname, $user_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `camagru`.`users`
			SET `firstname`=:firstname, `lastname`=:lastname
			WHERE `user_id`=:user_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':firstname', $firstname);
			$stmt->bindParam(':lastname', $lastname);
			$stmt->bindParam(':user_id', $user_id);
			if ($stmt->execute()) {
				return true;
			}
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return false;
	}

	/**
	 * changePassword($hash, $user_id)
	 *
	 * Func sets value `password` in $hash. This func returns true if params
	 * changed. And false if didn't
	 *
	 * @param $hash
	 * @param $user_id
	 * @return bool
	 */
	public static function changePassword($hash, $user_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `users`
			SET `password` = :hash
			WHERE `user_id` = :user_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':hash', $hash);
			$stmt->bindParam(':user_id', $user_id);
			if ($stmt->execute()) {
				return true;
			}
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return false;
	}

	/**
	 * changeAvatar($path, $user_id)
	 *
	 * Func sets value `avatar` in $path.
	 *
	 * @param $path
	 * @param $user_id
	 * @return bool
	 */
	public static function changeAvatar($path, $user_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `users`
			SET `avatar` = :path
			WHERE `user_id` = :user_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':path', $path);
			$stmt->bindParam(':user_id', $user_id);
			if ($stmt->execute()) {
				return true;
			}
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return false;
	}

	public static function delActiveHash($email)
	{
		try {
			$db = static::getDB();
			$sql = "
			UPDATE `users`
			SET `active_hash` = NULL, `active_time` = NULL
			WHERE `email` = :email;
			";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}
}