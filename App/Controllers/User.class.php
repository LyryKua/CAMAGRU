<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/21/17
 * Time: 12:33
 */

namespace App\Controllers;

/**
 * Class User
 *
 * @package App\Controllers
 */
class User extends \Core\Controller
{
	public function indexAction()
	{
		echo "Hello from User-index";
	}
	/**
	 * add new picture
	 *
	 * @return void
	 */
	public function addNewAction()
	{
		echo "adding new user";
		echo "<p>Query string parameters:<pre>" .
			htmlspecialchars(print_r($this->params)) . "</pre></p>";

	}

	/**
	 * del an own picture
	 *
	 * @return void
	 */
	public function delAction()
	{
		echo "deleting new user";
	}

	/**
	 * like a picture
	 *
	 * @return void
	 */
	public function likeAction()
	{
		echo "user liked a photo";
	}
}