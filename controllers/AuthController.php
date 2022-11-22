<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\Model\LoginForm;
use app\Model\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $this->setLayout('auth');
        return $this->load('login');
    }

    public function loginUSer(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        $loginForm->loadData($request->getBody());
        if ($loginForm->validate() && $loginForm->login()) {
            Application::$app->session->setFlash('success', 'You are LoggedIn now.');
            $response->redirect('/');
            return;
        }

    }


    public function showRegisterForm()
    {
        $this->setLayout('auth');
        return $this->load('register');
    }

    public function register(Request $request)
    {
        $errors = [];
        $user = new User();
        $user->loadData($request->getBody());
        if ($user->validate() && $user->create()) {
            Application::$app->session->setFlash('success', 'Registration is complete now.');
            Application::$app->response->redirect('/');
        }

        return $this->load('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        Application::$app->session->setFlash('success', 'You are LoggedOut now.');
        $response->redirect('/');
    }


}