<?php

namespace app\core;

use app\controllers\Controller;
use app\Model\LoginForm;
use app\Model\User;

class Application
{
    public Router $router;
    public Request $request;
    public Controller $controller;
    public Response $response;
    public Database $db;
    public Session $session;
    public ?User $user;

    public static Application $app;
    public static string $ROOT_DIR;
    public string $userClass;

    public function __construct($dirname,array $config)
    {
        self::$ROOT_DIR = $dirname;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,$this->response);
        $this->db = new Database($config['db']);
        $this->user = null;
        $this->userClass = $config['userClass'];

        $userId = Application::$app->session->get('user');
        if ($userId) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$key => $userId]);
        }


    }

    public function run()
    {
        echo $this->router->resolve();
    }
    public function login(User $user)
    {

        $this->user = $user;
        $className = get_class($user);
        $primaryKey = $className::primaryKey();
        $value = $user->{$primaryKey};
        Application::$app->session->set('user', $value);

        return true;
    }
    public function logout()
    {
        $this->user = null;
        self::$app->session->remove('user');
    }
    public static function isGuest()
    {
        return !self::$app->user;
    }
}