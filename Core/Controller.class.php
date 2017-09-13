<?php
/**
 * Created by PhpStorm.
 * User: khrechen
 * Date: 8/22/17
 * Time: 13:28
 */

namespace Core;

/**
 * Class Controller
 *
 * @package Core
 */
abstract class Controller
{
	/**
	 * Parameters from the matched route
	 *
	 * @var array
	 */
	protected $route_params = [];

	/**
	 * Controller constructor.
	 *
	 * Function fills $route_params from the route
	 *
	 * @param array $route_params Parameters from the route
	 */
	public function __construct($route_params)
	{
		$this->route_params = $route_params;
	}

	/**
	 * Magic method called when a non-existent or inaccessible method is
	 * called on an object of this class. Used to execute before and after
	 * filter methods on action methods. Action methods need to be named
	 * with an "Action" suffix, e.g. indexAction, showAction etc.
	 *
	 * @param string $name  Method name
	 * @param array $arguments Arguments passed to the method
	 *
	 * @return void
	 */
	public function __call($name, $arguments)
	{
		$method = $name . "Action";

		if (method_exists($this, $method)) {
			if ($this->before() !== false) {
				call_user_func_array([$this, $method], $arguments);
				$this->after();
			}
		} else {
			View::render('blocks/page404.php');
		}
	}

	/**
	 * Before filter - called before an action method.
	 *
	 * @return void
	 */
	protected function before()
	{
		if (isset($_SESSION['user_id'])) {
			echo "Авторизований!";
		} else {
			echo "Не авторизований :(";
		}
	}

	/**
	 * After filter - called after an action method.
	 *
	 * @return void
	 */
	protected function after()
	{
		if (isset($_SESSION['user_id'])) {
			echo "Авторизований!";
		} else {
			echo "Не авторизований :(";
		}
	}
}