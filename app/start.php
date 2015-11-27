<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('log_errors', true);
ini_set('error_log', __DIR__ . '/../logs/errors.txt');
date_default_timezone_set('Asia/Bangkok');

/*
 |--------------------------------------------------------------------------
 | Start PHP session
 |--------------------------------------------------------------------------
 */
session_start();

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/
require __DIR__ . '/../vendor/autoload.php';

/*
 |--------------------------------------------------------------------------
 | Set Container
 |--------------------------------------------------------------------------
 */
$container = new \Slim\Container();

/*
 |--------------------------------------------------------------------------
 | Set Configuration path
 |--------------------------------------------------------------------------
 */
$container['config'] = function ($c) {
	return new \Noodlehaus\Config('../config/local.php');
};

/*
 |--------------------------------------------------------------------------
 | Set View Use Twig Template
 |--------------------------------------------------------------------------
 */
$container['view'] = function ($c) {
	$view = new \Slim\Views\Twig('../app/views', [
        'cache' => '../app/cache'
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));

    return $view;
};

/*
 |--------------------------------------------------------------------------
 | Set Environment for Development or Production
 |--------------------------------------------------------------------------
 | 
 */
$app = new \Slim\App($container);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| Here is where you can register all of the routes for an application.
*/
require __DIR__ . '/routes.php';