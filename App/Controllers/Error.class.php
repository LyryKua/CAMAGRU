<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 10/1/17
 * Time: 03:15
 */

namespace App\Controllers;

use Core\View;

class Error extends \Core\Controller
{
	public function error404Action()
	{
		View::render('404.php', ['title' => 'camagru | 404']);
	}
}