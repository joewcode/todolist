<?php
namespace App;

use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('\App\Controllers');

// Set routes list
$router->get('/', 'IndexController@index');
$router->post('/task/new', 'TaskController@createTask');
$router->get('/task/edit/(\d+)', 'TaskController@editTask');
$router->post('/task/update/(\d+)', 'TaskController@updateTask');
$router->get('/task/delete/(\d+)', 'TaskController@deleteTask');
$router->get('/task/confirm/(\d+)', 'TaskController@confirmTask');

//
$router->post('/auth/login', 'AuthController@login');



$router->set404(function(){
	echo twig()->render('404.html');
});

$router->run();
