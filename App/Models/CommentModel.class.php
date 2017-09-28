<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 9/28/17
 * Time: 13:25
 */

namespace App\Models;

use PDO;

class CommentModel extends \Core\Model
{
	/**
	 * insertComment($text, $user_id, $photo_id)
	 *
	 * The function insert a comment.
	 *
	 * @param $text
	 * @param $user_id
	 * @param $photo_id
	 */
	public static function insertComment($text, $user_id, $photo_id)
	{
		try {
			$db = static::getDB();
			$sql = '
			INSERT INTO `comments` (
				`text`, `user_id`, `photo_id`)
			VALUES (
				:text, :user_id, :photo_id);
			';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':text', $text);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':photo_id', $photo_id);
			$stmt->execute();
		} catch (\PDOException $e) {
			$e->getMessage();
		}
	}
}