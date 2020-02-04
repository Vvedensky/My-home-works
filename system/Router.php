<?php

namespace System;

class router
{
    private $routes;
    private $params;

    /**
     * берем список роутов и добавляем в приватное свойство
     * router constructor.
     */
    public function __construct()
    {
        $result = include 'routes.php';
        foreach ($result as $key => $value){
            $this->add($key, $value);
        }
    }

    public function add($route,$params){
        $route = '/'.$route.'/';
        $this->routes[$route] = $params;
    }

    /**
     * определяем есть ли указанный роутер в списке
     * @return bool
     */
    public function match(){
        $url = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $route => $params){
            if(strpos($url, $route)){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * запускаем нужный контроллер и метод
     * именование файлов и классов контроллеров с большой буквы!
     */
    public function run(){
        if($this->match()){

            $controller = '\Controller\\'.ucfirst($this->params['controller']);
            $action = $this->params['action'];

            $controller_object = new $controller;
            if (!empty($action)) {
                $controller_object->$action();
            } else {
                $controller_object->index();
            }

        } else {
            echo 404;
        }
    }
}