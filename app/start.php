<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('log_errors', true);
ini_set('error_log', __DIR__ . '/../logs/errors.txt');
date_default_timezone_set('Asia/Bangkok');

session_start();

use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/database.php';

$app = new \Slim\Slim([
	'view' => new \Slim\Views\Twig()
]);

$app->add(new App\Middleware\CsrfMiddleware);

/*
 * Set View Use Twig Template
 */
$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserOptions = [
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
];
$view->parserExtensions = [
	new \Slim\Views\TwigExtension(),
];

/*
 * Connect Database with Eloquent
 * Use $app->db->table()->where()->get(); for query
 * Edit database.php
 */
$app->db = function() {
	return new Capsule;
};

require __DIR__ . '/routes.php';