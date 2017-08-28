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
	protected $params;

	/**
	 * Controller constructor.
	 *
	 * @param array $params
	 */
	public function __construct($params)
	{
		$this->params = $params;
	}

	/**
	 * @param $name
	 * @param $arguments
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
			echo "Method $method not found in controller " . get_class($this);
		}
	}

	/**
	 * Before filter - called before an action method.
	 *
	 * @return void
	 */
	protected function before()
	{
	}

	/**
	 * After filter - called after an action method.
	 *
	 * @return void
	 */
	protected function after()
	{
	}
}