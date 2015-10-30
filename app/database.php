<?php
$config = include(__DIR__ . '/../config/local.php');

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => $config['db']['driver'],
    'host'      => $config['db']['host'],
    'database'  => $config['db']['database'],
    'username'  => $config['db']['username'],
    'password'  => $config['db']['password'],
    'charset'   => $config['db']['charset'],
    'collation' => $config['db']['collation'],
    'prefix'    => $config['db']['prefix'],
]);

// Make this Capsule instance available globally via static methods...
$capsule->setAsGlobal();
// Setup the Eloquent ORM
$capsule->bootEloquent();