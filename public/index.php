<?php

require_once __DIR__ . '/../core/Router.php';

$router = new Router();

/*-------- WEB ROUTE ----------*/
$router->get('/', 'BookController@list');

/*-------- API ROUTE ----------*/
$router->post('/api/authors', 'AuthorController@store'); // Создать нового автора

$router->dispatch();