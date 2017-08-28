<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/22/17
 * Time: 12:16
 */

namespace App\Controllers;

use \Core\View;

/**
 * Class Home
 *
 * @package App\Controllers
 */
class Home extends \Core\Controller
{
	/**
	 * @return void
	 */
	protected function before()
	{
	}

	/**
	 * @return void
	 */
	protected function after()
	{
	}

	/**
	 * this func shows list of all picture in DB
	 *
	 * @return void
	 */
	public function indexAction()
	{
		View::render('index.php', [
			'title'		=>	'camagru | All photos',
			'colors'	=>	['red', 'blue', 'green'],
			'name'		=>	'LyryK.ua'
		]);
	}

	/**
	 * show a single post
	 *
	 * @return void
	 */
	public function showAction()
	{
		echo "Showed a single post!";
	}
}