<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/23/17
 * Time: 16:00
 */

namespace Core;

/**
 * Class View
 *
 * @package Core
 */

class View
{
	/**
	 * Render a view file
	 *
	 * @param string $view	The view file
	 *
	 * @return void
	 */
	public static function render($view)
	{
		$file = "../App/Views/$view"; // relative to Core directory

		if (is_readable($file)) {
			require $file;
		} else {
			echo "<h1>404</h1>$file not found";
		}
	}
}