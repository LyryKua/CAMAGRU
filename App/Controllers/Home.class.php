<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/22/17
 * Time: 12:16
 */

namespace App\Controllers;

/**
 * Class Home
 *
 * @package App\Controllers
 */
class Home extends \Core\Controller
{
	/**
	 * this func shows list of all picture in DB
	 *
	 * @return void
	 */
	public function indexAction()
	{
		echo "list of all picture";
//		echo "<p>Query string parameters:<pre>" . htmlspecialchars(print_r($_GET, true)) . "</pre></p>";
	}

	/**
	 * show a single post
	 *
	 * @return void
	 */
	public function show()
	{
		echo "Showed a single post!";
	}
}