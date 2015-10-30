<?php

use App\Models\User;
use App\Controllers\UserController;

$app->get('/', function() use ($app){
	$user = new User;
	$app->render('home.php',[
		'name' => $user->name
	]);
})->name('home');

$app->get('/test', function() use ($app){
	echo "test";
});

$app->get('/users/:id', function($id) use ($app){
	$users = new UserController;
	print_r($users->getUsers($id));
});
