<?php

use app\controllers\AuthController;
use app\controllers\ContactController;
use app\controllers\HomeController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));
$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/contact', [ContactController::class, 'createContact']);
$app->router->post('/contact', [ContactController::class, 'SaveContact']);
$app->router->get('/login', [AuthController::class, 'showLoginForm']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'showRegisterForm']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->run();