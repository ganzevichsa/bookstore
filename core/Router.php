<?php

/**
 * Класс отвечающий за маршрутизацию.
 */

class Router {
    protected $routes = [];

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function put($uri, $controller) {
        $this->routes['PUT'][$uri] = $controller;
    }

    public function destroy($uri, $controller) {
        $this->routes['DESTROY'][$uri] = $controller;
    }

    /**
     * Обработка запроса.
     */
    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Проверяем есть ли такой маршрут
        if(array_key_exists($uri, $this->routes[$method])) {
            $controllerAction = $this->routes[$method][$uri];
            $this->callControllerAction($uri, $controllerAction);
        } else {
            http_response_code(404);
            echo "404";
        }
    }

    /**
     * Вызов контроллера и его метода.
     */
    protected function callControllerAction($uri, $controllerAction) {
        //разделяем строку по символу '@' и присваиваем значения в переменные.
        list($controller, $action) = explode('@', $controllerAction);

        //определяем путь к контроллеру в зависимости от uri
        $path = (strpos($uri, 'api') !== false) ? 
            __DIR__ . "/../app/Controllers/Api/{$controller}.php" :
            __DIR__ . "/../app/Controllers/{$controller}.php";

        // подключаем контроллер
        require_once $path;

        // вызываем соответсвующий метод
        $currentController = new $controller();
        $currentController->{$action}();
    } 
}