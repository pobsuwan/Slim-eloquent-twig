<?php

use App\Models\User;

$app->get('/', function() use ($app){
	$user = new User;
	//echo $user->name;
	$app->render('home.php',[
		'name' => $user->name
	]);
})->name('home');

$app->get('/test', function() use ($app){
	var_dump($app->db);
});

