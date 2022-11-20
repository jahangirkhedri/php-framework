<?php

use app\controllers\ContactController;
use app\controllers\HomeController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));
$app->router->get('/', [HomeController::class,'home']);
$app->router->get('/contact',  [ContactController::class, 'createContact']);
$app->router->post('/contact', [ContactController::class, 'SaveContact']);


$app->run();