<?php
$app->get('/', function($request, $response, $args){
	$this->view->render($response ,'home.twig', [
        'name' => 'Apiwat'
    ]);
})->setName('home');

$app->get('/db', function($request, $response, $args) {
	print_r($this->db->table('users')->get());
});