<?php
require_once __DIR__ . '/../Interface/ControllerInterface.php';

/**
 * Абстрактный класс, основные функции для контроллеров.
 */
abstract class BaseController implements ControllerInterface {

    protected $repository;

    /**
     * Метод-конструктор.
     */
    public function __construct($repository) {
        $this->repository = new $repository();
    }

    /**
     * Метод для отображения представления.
     */
    public function view($view, $data = []) {
        require_once __DIR__ . "/../../resource/views/{$view}.php";
    }
}