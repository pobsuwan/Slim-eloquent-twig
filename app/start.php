<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\Slim([
	'view' => new \Slim\Views\Twig()
]);

$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserExtensions = [
	new \Slim\Views\TwigExtension(),
];

require 'routes.php';

/*
 * Connect Database with PDO
 * Use $app->db->query("")->fetchAll(PDO::FETCH_ASSOC); for query
 *
 */
/*$app->container->singleton('db', function() {
	return new PDO('mysql:host=127.0.0.1;dbname=dbname','root','pass');
});*/