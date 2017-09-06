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
	 * render($view, $args = ['title' => 'camagru'])
	 *
	 * Render a view file
	 *
	 * @param string $view	The view file
	 * @param array $args	data for $view
	 *
	 * @return void
	 */
	public static function render($view, $args = ['title' => 'camagru'])
	{
		extract($args, EXTR_SKIP);

		$file = "../App/Views/$view"; // relative to Core directory

		if (is_readable($file)) {
			require $file;
		} else {
			echo "<h1>404</h1>$file not found";
		}
	}
}