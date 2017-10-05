<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 9/28/17
 * Time: 13:25
 */

namespace App\Models;

use PDO;

class NotificationsModel extends \Core\Model
{
	/**
	 * insertNotification($user_id, $text, $photo_id)
	 *
	 * The func inerts a notification to table.
	 *
	 * @param $user_id
	 * @param $text
	 * @param $photo_id
	 */
	public static function insertNotification($user_id, $text, $photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			INSERT INTO `notifications` (
				`user`, `text`, `photo`)
			VALUES (
				:user_id, :text, :photo_id);
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':text', $text);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	public static function deleteNotification($user_id, $text, $photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			DELETE FROM `notifications`
			WHERE `user` = :user_id AND `text` = :text AND `photo` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':text', $text);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	public static function getNotificationForUser($user_id)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT `users`.`login`, `notifications`.`text`, `notifications`.`photo`
			FROM `photos`
			JOIN `notifications`
			ON `photos`.`photo_id` = `notifications`.`photo`
			JOIN `users`
			ON `notifications`.`user` = `users`.`user_id`
			WHERE `photos`.`user_id` = :user_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->execute();
			$row = $stmt->fetchAll();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return ($row);
	}

	public static function deleteNotificationForUser($user_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			DELETE `notifications` FROM `photos`
			JOIN `notifications`
			ON `photos`.`photo_id` = `notifications`.`photo`
			JOIN `users`
			ON `notifications`.`user` = `users`.`user_id`
			WHERE `photos`.`user_id` = :user_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	public static function getEmailForNotification($photo_id)
	{
		$to = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT `users`.`login`, `users`.`email`
			FROM `photos`
			JOIN `users`
			ON `photos`.`user_id` = `users`.`user_id`
			WHERE `photos`.`photo_id` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
			$to = $stmt->fetch(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return ($to);
	}
}