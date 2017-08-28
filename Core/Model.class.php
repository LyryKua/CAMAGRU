<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/28/17
 * Time: 14:59
 */

namespace Core;

use PDO;

/**
 * Class Model
 *
 * @package Core
 */
abstract class Model
{
	/**
	 *
	 */
	protected static function getDB()
	{
		static $db = null;
		if ($db === null) {
			$host = "localhost";
			$dbname = "camagru";
			$user = "root";
			$password = "256512";

			try {
				$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
					$user, $password);
				return $db;
			} catch (\PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}