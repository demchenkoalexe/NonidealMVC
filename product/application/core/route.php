<?php

 /*Класс маршрутизации*/
class Route
{
    static function start() {
        //контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        $getter = False;

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( $routes[1][0] == '?') {
            $getter = True;
        }

        // получаем имя контроллера
        if ( !empty($routes[1]) and !$getter ) {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) and !$getter ) {
            $action_name = $routes[2];
        }

        // добавляем префиксы
        $model_name = 'Model'.ucfirst($controller_name);
        $controller_name = 'Controller'.ucfirst($controller_name);
        $action_name = 'action'.ucfirst($action_name);

        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = lcfirst($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if ( file_exists($model_path) ) {
            include "application/models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = lcfirst($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if ( file_exists($controller_path) ) {
            include "application/controllers/".$controller_file;
        } else {
            Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if ( method_exists($controller, $action) ) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    }

    function ErrorPage404() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}