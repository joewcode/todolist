<?php
require __DIR__ .'/vendor/autoload.php';
require __DIR__ .'/env.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
		'driver' => SQL_DRIVER, 
		'host' => SQL_HOST, 
		'database' => SQL_DATABASE, 
		'username' => SQL_USERNAME, 
		'password' => SQL_PASSWORD
	]);
	
//Make this Capsule instance available globally
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();

// Setup the Twig config
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ .'/template/'. TEMPLATE_CURRENT);
$twig = new \Twig\Environment($loader, [
		'cache' => false, //__DIR__ .'/cache/tpl',
	]);
// ..why not
function twig(){
	return $GLOBALS['twig'];
}

