<?php

/**
 * Class Router
 */

namespace Core;

class Router
{
	/**
	 * Associative array of routes (the routing table)
	 * 'route' => ['controller' => 'action']
	 *
	 * @var array
	 */
	protected $routes = [];

	/**
	 * Parameters from the matched route
	 *
	 * @var array
	 */
	protected $params = [];

	/**
	 * Add a route to the routing table
	 *
	 * @param string $route The route URL
	 * @param array $params Parameters (controller, action)
	 * @return void
	 */
	public function add($route, $params = [])
	{
		// Convert the route to a regular expression: escape forward slashes
		$route = preg_replace('/\//', '\\/', $route);

		// Convert variables e.g. {controller}
		$route = preg_replace('/\{([\da-z-]+)\}/', '(?P<\1>[\da-z-]+)', $route);

		// Add start and end delimiters, and case insensitive flag
		$route = '/^' . $route . '$/i';

		$this->routes[$route] = $params;
	}

	/**
	 * Get all the routes from the routing table
	 *
	 * @return array
	 */
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * Match the routing to the routes int the routing table,
	 *
	 * @param string $url The URL
	 * @return bool
	 */
	public function match($url)
	{
		/*
//        foreach ($this->routes as $route => $value) {
//            if ($url == $route) {
//                $this->params = $value;
//                return true;
//            }
//        }
//        return false;

//        $reg_exp = '/^(?P<controller>[\da-z-]+)\/(?P<action>[\da-z-]+)$/';
//        if(preg_match($reg_exp, $url, $matches)) {
//            $params = [];
//            foreach ($matches as $key => $match) {
//                if (is_string($key)) {
//                    $params[$key] = $match;
//                }
//            }
//            $this->params = $params;
//            return true;
//        }
//        return false;
		*/
		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $matches)) {
				foreach ($matches as $key => $match) {
					if (is_string($key)) {
						$params[$key] = $match;
					}
				}
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	/**
	 * Returns an array params
	 *
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

	/**
	 * Func convert name of method and action to normal format
	 *
	 * @param string $url The URL
	 *
	 * @return void
	 */
	public function dispatch($url)
	{
		if ($this->match($url)) {
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);
			$controller = "App\\Controllers\\$controller";

			if (class_exists($controller)) {
				$obj = new $controller();

				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);
				if (is_callable([$obj, $action])) {
					$obj->$action();

				} else {
					echo "Action $action in class $controller doesn't exist";
				}
			} else {
				echo "Class $controller doesn't exist!";
			}
		} else {
			echo "<h1>404</h1>";
		}
	}

	/**
	 * convertToStudlyCaps is converting input string to StudlyCups
	 *
	 * @param string $str String which will have converted
	 *
	 * @return string
	 */
	private function convertToStudlyCaps($str)
	{
		return str_replace("-", "", ucwords($str, "-"));
	}


	/**
	 * convertToCamelCase is converting input string to camelCase
	 *
	 * @param string $str String which will have converted
	 *
	 * @return string
	 */
	private function convertToCamelCase($str)
	{
		return lcfirst($this->convertToStudlyCaps($str));
	}
}