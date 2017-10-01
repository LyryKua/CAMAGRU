<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 9/27/17
 * Time: 12:53
 */

namespace App\Models;

use PDO;

class PhotoModel extends \Core\Model
{
	/**
	 * insertPhoto($path, $user_id)
	 *
	 * The function insert full path to photo.
	 *
	 * @param $path
	 * @param $user_id
	 */
	public static function insertPhoto($path, $user_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			INSERT INTO `photos` (
				`path`, `user_id`)
			VALUES (
				:path, :user_id);
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':path', $path);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	/**
	 * getAllPhotos()
	 *
	 * @return bool|mixed
	 */
	public static function get10Photos($offset)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = "
			SELECT `p`.*, `u`.`login`, `u`.`avatar` FROM `photos` AS `p`
			LEFT JOIN `users` AS `u`
			ON `p`.`user_id` = `u`.`user_id`
			ORDER BY `photo_id` DESC
			LIMIT 10 OFFSET $offset;
			";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetchAll();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return ($row);
	}

	public static function countAllPhotos()
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT COUNT(*) FROM `photos`
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->execute();
			$row = $stmt->fetch()[0];
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return ($row);
	}

	/**
	 * getAllPhotos()
	 *
	 * @return bool|mixed
	 */
	public static function getPhotosByUserID($user_id)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT * FROM `photos`
			WHERE `user_id` = :user_id
			ORDER BY photo_id DESC
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

	public static function countPhotosByUserID($user_id)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT COUNT(*) FROM `photos`
			WHERE `user_id` = :user_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->execute();
			$row = $stmt->fetch()[0];
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return ($row);
	}

	/**
	 * getCommentsToPhoto($photo_id)
	 *
	 * This function get all comments and author to a photo.
	 *
	 * The return value of this function is an array indexed by column name.
	 * Function returns false, if the comments was not found
	 *
	 * array (size=2)
	 *        0 =>
	 *            array (size=4)
	 *                'text' => string 'Luke, I am your father' (length=22)
	 *                0 => string 'Luke, I am your father' (length=22)
	 *                'login' => string 'darth_vader' (length=11)
	 *                1 => string 'darth_vader' (length=11)
	 *        1 =>
	 *            array (size=4)
	 *                'text' => string 'Noooooooooooo!' (length=14)
	 *                0 => string 'Noooooooooooo!' (length=14)
	 *                'login' => string 'luke' (length=4)
	 *                1 => string 'Luke' (length=4)
	 *
	 *
	 * @param $photo_id
	 * @return bool|mixed
	 */
	public static function getCommentsToPhoto($photo_id)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT `c`.`text`, `u`.`login` FROM `comments` AS `c`
			LEFT JOIN `users` AS `u` ON `c`.`user_id` = `u`.`user_id`
			WHERE `c`.`photo_id` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
			$row = $stmt->fetchAll();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return $row;
	}

	public static function getPhotoByID($photo_id)
	{
		$row = false;
		try {
			$db = static::getDB();
			$sql = '
			SELECT `p`.*, `u`.`login`, `u`.`avatar` FROM `photos` AS `p`
			LEFT JOIN `users` AS `u`
			ON `p`.`user_id` = `u`.`user_id`
			WHERE `photo_id` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			$e->getMessage();
		}
		return $row;
	}

	public static function like($photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `photos`
			SET `likes` = `likes` + 1
			WHERE `photo_id` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}

	public static function dislike($photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			UPDATE `photos`
			SET `likes` = `likes` - 1
			WHERE `photo_id` = :photo_id;
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}
}