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
		'debug' => true,
        'cache' => '../app/cache'
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
    	$c['router'],
    	$c['request']->getUri())
    );
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

/*
 |--------------------------------------------------------------------------
 | Set Flash messages
 |--------------------------------------------------------------------------
 */
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

/*
 |--------------------------------------------------------------------------
 | Connect Database with Eloquent
 |--------------------------------------------------------------------------
 | How to Use : $this->db->table()->where()->get(); for query
 */
$container['db'] = function ($c) {
	$capsule = new \Illuminate\Database\Capsule\Manager;
	$capsule->addConnection([
	    'driver'    => $c['config']->get('db.driver'),
	    'host'      => $c['config']->get('db.host'),
	    'database'  => $c['config']->get('db.database'),
	    'username'  => $c['config']->get('db.username'),
	    'password'  => $c['config']->get('db.password'),
	    'charset'   => $c['config']->get('db.charset'),
	    'collation' => $c['config']->get('db.collation'),
	    'prefix'    => $c['config']->get('db.prefix'),
	]);
	// Make this Capsule instance available globally via static methods...
	$capsule->setAsGlobal();
	// Setup the Eloquent ORM
	$capsule->bootEloquent();
	return $capsule;
};

/*
 |--------------------------------------------------------------------------
 | Add csrf middleware
 |--------------------------------------------------------------------------
 | Register middleware for all routes
 | If you are implementing per-route checks you must not add this
 */
$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
};

/*
 |--------------------------------------------------------------------------
 | Set Environment for Development or Production
 |--------------------------------------------------------------------------
 | 
 */
$app = new \Slim\App($container);

$app->config([
    'debug' => true
]);

/*
 |--------------------------------------------------------------------------
 | Configuration for mode 'development'
 |--------------------------------------------------------------------------
 | Set the configs for development environment
 | Only invoked if mode is 'development'
 */
/*$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => true
    ));
});
*/
/*
 |--------------------------------------------------------------------------
 | Configuration for mode 'production'
 |--------------------------------------------------------------------------
 | Set the configs for production environment
 | Only invoked if mode is 'production'
 */
/*$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| Here is where you can register all of the routes for an application.
*/
require __DIR__ . '/routes.php';