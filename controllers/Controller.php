<?php

namespace app\controllers;

use app\core\Application;

class Controller
{
    public $layout = 'main';
    public function load($view, $params = [])
    {
        return Application::$app->router->loadView($view, $params);
    }

    public function setLayout($layout)
    {

       $this->layout = $layout;
    }

}