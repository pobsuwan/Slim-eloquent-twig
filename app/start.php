<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('log_errors', true);
ini_set('error_log', __DIR__ . '/../logs/errors.txt');
date_default_timezone_set('Asia/Bangkok');

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
require __DIR__ . '/database.php';

/*
 |--------------------------------------------------------------------------
 | Set Environment for Development or Production
 |--------------------------------------------------------------------------
 | If your run on the production then change mode to 'production'.
 */
$app = new \Slim\Slim([
	'mode' => 'development',
	'view' => new \Slim\Views\Twig()
]);

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
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => true
    ));
});

/*
 |--------------------------------------------------------------------------
 | Configuration for mode 'production'
 |--------------------------------------------------------------------------
 | Set the configs for production environment
 | Only invoked if mode is 'production'
 */
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});

/*
 |--------------------------------------------------------------------------
 | Add Csrf Middleware
 |--------------------------------------------------------------------------
 */
$app->add(new App\Middleware\CsrfMiddleware);

/*
 |--------------------------------------------------------------------------
 | Set View Use Twig Template
 |--------------------------------------------------------------------------
 */
$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserOptions = [
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
];

/*
 |--------------------------------------------------------------------------
 | Set View Use Twig Extension
 |--------------------------------------------------------------------------
 */
$view->parserExtensions = [
	new \Slim\Views\TwigExtension(),
	new \Twig_Extension_Debug()
];

/*
 |--------------------------------------------------------------------------
 | Connect Database with Eloquent
 |--------------------------------------------------------------------------
 | Use $app->db->table()->where()->get(); for query
 | Edit database.php
 */
use Illuminate\Database\Capsule\Manager as Capsule;
$app->db = function() {
	return new Capsule;
};

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| Here is where you can register all of the routes for an application.
*/
require __DIR__ . '/routes.php';