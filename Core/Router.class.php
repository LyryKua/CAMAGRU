<?php

/**
 * Class Router
 */

namespace Core;

/**
 * Class Router
 *
 * @package Core
 */
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
	 * add($route, $params = [])
	 *
	 * Add a route to the routing table
	 *
	 * @param string $route The route URL
	 * @param array $params Parameters (controller, action)
	 *
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
	 * getRoutes()
	 *
	 * Get all the routes from the routing table
	 *
	 * @return array
	 */
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * match($url)
	 *
	 * Match the route to the routes in the routing table, setting the $params
	 * property if a route is found.
	 *
	 * @param string $url The route URL
	 *
	 * @return boolean  true if a match found, false otherwise
	 */
	public function match($url)
	{
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
	 * getParams()
	 *
	 * Get the currently matched parameters
	 *
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

	/**
	 * dispatch($url)
	 *
	 * Dispatch the route, creating the controller object and running the
	 * action method
	 *
	 * @param string $url The URL
	 *
	 * @return void
	 */
	public function dispatch($url)
	{
		$url = $this->removeQueryStringVariables($url);
		if ($this->match($url)) {
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);
			$controller = $this->getNamespace() . $controller;
			if (class_exists($controller)) {
				$controller_object = new $controller($this->params);
				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);
				if (preg_match('/action$/i', $action) == 0) {
					$controller_object->$action();
				} else {
//					throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
					header('Location: /404');
					exit();
//					echo "Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method";
				}
			} else {
//				throw new \Exception ("Controller class $controller not found");
				header('Location: /404');
				exit();
//				echo "Controller class $controller not found";
			}
		} else {
//			throw new \Exception ('No route matched.', 404);
			header('Location: /404');
			exit();
//			echo 'No route matched.';
		}
	}

	/**
	 * convertToStudlyCaps($str)
	 *
	 * Convert the string with hyphens to StudlyCaps,
	 * e.g. post-authors => PostAuthors
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
	 * convertToCamelCase($str)
	 *
	 * Convert the string with hyphens to camelCase,
	 * e.g. add-new => addNew
	 *
	 * @param string $str String which will have converted
	 *
	 * @return string
	 */
	private function convertToCamelCase($str)
	{
		return lcfirst($this->convertToStudlyCaps($str));
	}

	/**
	 * removeQueryStringVariables($url)
	 *
	 * Remove the query string varables from the URL (if ane). As the full
	 * query string is used for the route, ane variavles at the end will need
	 * to be removed before the route is matched to the routing table. For
	 * example:
	 *
	 *           URL                |   $_SERVER['QUERY_STRING']   |      Route
	 * -----------------------------|------------------------------|---------------
	 * localhost                    |    ''                        |    ''
	 * localhost/?                  |    ''                        |    ''
	 * localhost/?page=1            |    page=1                    |    ''
	 * localhost/posts?page=1       |    posts/&page=1             |    posts
	 * localhost/posts/index        |    posts/index               |    posts/index
	 * localhost/posts/index?page=1 |    posts/index&page=1        |    posts/index
	 *
	 * A URL of the format localhost/?page (one variable name, no value) won't
	 * work however. (NB. The .htaccess file converts the first ? to a & when
	 * it's passed throught to the $_SERVER variable).
	 *
	 * @param string $url The full URL
	 *
	 * @return string The URL without query sting
	 */
	protected function removeQueryStringVariables($url)
	{
		if ($url != '') {
			$parts = explode('&', $url, 2);
			if (strpos($parts[0], '=') === false) {
				$url = $parts[0];
			} else {
				$url = '';
			}
		}
		return $url;
	}

	/**
	 * Get the namespace for the controller class. The namespace defined in the
	 * route parameters is added if present.
	 *
	 * @return string The request URL
	 */
	protected function getNamespace()
	{
		$namespace = 'App\Controllers\\';
		if (array_key_exists('namespace', $this->params)) {
			$namespace .= $this->params['namespace'] . '\\';
		}
		return $namespace;
	}
}