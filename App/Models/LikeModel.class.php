<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 9/27/17
 * Time: 12:53
 */

namespace App\Models;

use PDO;

class LikeModel extends \Core\Model
{
	public static function index($user_id, $photo_id)
	{
		if (self::checkItem($user_id, $photo_id)) {
			self::addItem($user_id, $photo_id);
			return true;
		} else {
			return false;
		}
	}

	protected function addItem($user_id, $photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			INSERT INTO `liked` (
				`user`, `photo`)
			VALUES (
				:user_id, :photo_id);
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	public static function delItem($user_id, $photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			DELETE FROM `liked`
			WHERE `user` = :user_id AND `photo` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	protected function checkItem($user_id, $photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			SELECT * FROM `liked`
			WHERE `user` = :user_id AND `photo` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
			if ($stmt->fetch(\PDO::FETCH_ASSOC) !== false) {
				return false;
			}
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return true;
	}

	public static function getUserLike($user_id)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT *
			FROM `liked`
			WHERE `user`=?;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $user_id);
			$stmt->execute();
			$row = $stmt->fetchAll();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return $row;
	}
}