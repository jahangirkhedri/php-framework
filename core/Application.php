<?php

namespace app\core;

use app\controllers\Controller;

class Application
{
    public Router $router;
    public Request $request;
    public Controller $controller;
    public Response $response;
    public Database $db;

    public static Application $app;
    public static string $ROOT_DIR;

    public function __construct($dirname,array $config)
    {
        self::$ROOT_DIR = $dirname;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,$this->response);
        $this->db = new Database($config['db']);


    }

    public function run()
    {
        echo $this->router->resolve();
    }
}