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
 * index()
 *
 *
 * @package App\Controllers
 */
class Post extends \Core\Controller
{
	/**
	 * this func shows list of all picture in DB
	 *
	 * @return void
	 */
	public function allAction()
	{
		View::render('index.php');
	}

	/**
	 * show a single post
	 *
	 * @return void
	 */
	public function singleAction()
	{
		View::render('single-post.php');
	}
}