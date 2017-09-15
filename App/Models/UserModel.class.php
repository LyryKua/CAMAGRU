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
			WHERE `users`.`login`=:login;
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
}