<?php
/**
 * Front controller
 */

session_start();

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
$url = trim($_SERVER['QUERY_STRING'], '/');

// Adding routes to the routing table
$router->add('', ['controller' => 'Post', 'action' => 'all']);
$router->add('post', ['controller' => 'Post', 'action' => 'all']);
$router->add('user', ['controller' => 'User', 'action' => 'index']);
$router->add('log-out', ['controller' => 'User', 'action' => 'logOut']);
$router->add('sign-up', ['controller' => 'Authorization', 'action' => 'signUp']);
$router->add('log-in', ['controller' => 'Authorization', 'action' => 'logIn']);
$router->add('reset-password', ['controller' => 'Authorization', 'action' => 'resetPassword']);
$router->add('post/\d+', ['controller' => 'Post', 'action' => 'single']);
$router->add('{controller}/{action}');

$router->dispatch($url);
//var_dump($_SESSION['logged_user']);