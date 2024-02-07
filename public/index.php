<?php

require_once __DIR__ . '/../core/Router.php';

$router = new Router();

$router->get('/', 'BookController/index');

$router->dispatch();