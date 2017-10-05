<?php

session_start();

require_once('database.php');

$sql = file_get_contents('db.sql');
try {
	$dsn = "mysql:host=" . DB_HOST . ";charset=utf8";
	$db = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (\PDOException $e) {
	echo $e->getMessage();
}
$res = $db->query($sql);
if (isset($_SESSION['logged_user'])) {
	unset($_SESSION['logged_user']);
}


$dir = '../uploads';
if (file_exists($dir)) {
	function removeDirectory($dir)
	{
		foreach ($objs = glob($dir . "/*") as $obj) {
			is_dir($obj) ? removeDirectory($obj) : unlink($obj);
		}
		rmdir($dir);
	}

	removeDirectory($dir);
}

echo "
<h4>DB re-created</h4>
<a href='/'>Go to project!</a>
";
