<?php
ini_set('display_errors', 'On');

session_start();

use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';
require 'database.php';

$app = new \Slim\Slim([
	'view' => new \Slim\Views\Twig()
]);

$app->add(new App\Middleware\CsrfMiddleware);

/*
 * Set View Use Twig Template
 */
$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserExtensions = [
	new \Slim\Views\TwigExtension(),
];

/*
 * Connect Database with Eloquent
 * Use $app->db->table()->where()->get(); for query
 * Edit Database.php
 */
$app->db = function() {
	return new Capsule;
};

require 'routes.php';

/*
 * Connect Database with PDO
 * Use $app->db->query("")->fetchAll(PDO::FETCH_ASSOC); for query
 *
 */
/*$app->container->singleton('db', function() {
	return new PDO('mysql:host=127.0.0.1;dbname=dbname',
        'root','pass',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
});*/