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
	 * @param string $view The view file
	 * @param array $args Associative array of data to display in the view (optional)
	 * @throws \Exception
	 */
	public static function render($view, $args = ['title' => 'camagru'])
	{
		extract($args, EXTR_SKIP);

		$file = dirname(__DIR__) . "/App/Views/$view"; // relative to Core directory

		if (is_readable($file)) {
			require_once($file);
		} else {
			throw new \Exception("$file not found");
		}
	}
}