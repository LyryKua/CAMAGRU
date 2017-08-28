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
	 *
	 */
	protected static function getDB()
	{
		static $db = null;
		if ($db === null) {
			try {
				$dsn = "mysql:host=" . Configuration::DB_HOST . ";dbname=" . Configuration::DB_NAME . ";charset=utf8";
				$db = new PDO($dsn, Configuration::DB_USER, Configuration::DB_PASSWORD);
				return $db;
			} catch (\PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}