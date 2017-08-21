<?php
/**
 * Front controller
 */

//require '../Core/Router.class.php';
//
//require '../App/Controllers/AuthorizationModel.class.php';
//require '../App/Controllers/User.class.php';

/*
 * Autoloader
 */
spl_autoload_register(function ($class) {
	$root = dirname(__DIR__); // get the parent directory
	$file = $root . '/' . str_replace('\\', '/', $class) . '.class.php';
	if (is_readable($file)) {
		require $root . '/' . str_replace('\\', '/', $class) . '.class.php';
	}
});

$router = new Core\Router();
$url = $_SERVER['QUERY_STRING'];

// Adding routes to the routing table
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('sign-up', ['controller' => 'AuthorizationModel', 'action' => 'signUp']);
$router->add('log-in', ['controller' => 'AuthorizationModel', 'action' => 'logIn']);
$router->add('log-out', ['controller' => 'AuthorizationModel', 'action' => 'logOut']);
$router->add('user', ['controller' => 'User', 'action' => 'index']);
//$router->add('user/add', ['controller' => 'User', 'action' => 'add']);
//$router->add('user/del', ['controller' => 'User', 'action' => 'del']);
//$router->add('user/like', ['controller' => 'User', 'action' => 'like']);
$router->add('{controller}/{action}');

$router->dispatch($url);
//	if (class_exists($params['controller'])) {
//		$obj = new $params['controller'];
//		$obj->$params['action']();
//	}
//	else {
//		echo "Didnt find Class";
//	}
