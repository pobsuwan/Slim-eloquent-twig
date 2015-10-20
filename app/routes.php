<?php 
// load all routes
foreach (glob(__DIR__ . '/routes/'.'*php') as $routes) {
    require_once $routes;
}