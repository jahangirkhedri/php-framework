<?php

namespace app\core;

class Application
{
    public Router $router;
    public Request $request;
    public static string $ROOT_DIR;
    public Response $response;
    public static Application $app;
    public function __construct($dirname)
    {
        self::$ROOT_DIR = $dirname;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,$this->response);


    }

    public function run()
    {
        echo $this->router->resolve();
    }
}