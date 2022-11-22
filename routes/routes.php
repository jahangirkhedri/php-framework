<?php

use app\controllers\AuthController;
use app\controllers\ContactController;
use app\controllers\HomeController;

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/contact', [ContactController::class, 'createContact']);
$app->router->post('/contact', [ContactController::class, 'SaveContact']);
$app->router->get('/login', [AuthController::class, 'showLoginForm']);
$app->router->post('/login', [AuthController::class, 'loginUSer']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/register', [AuthController::class, 'showRegisterForm']);
$app->router->post('/register', [AuthController::class, 'register']);