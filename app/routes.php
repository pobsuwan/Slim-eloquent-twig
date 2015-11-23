<?php 
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| Here is where you can register all of the routes for an application.
*/
foreach (glob(__DIR__ . '/routes/'.'*php') as $routes) {
    require_once $routes;
}