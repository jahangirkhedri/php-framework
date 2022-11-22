<?php

namespace app\controllers;

use app\core\Request;
use app\Model\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $this->setLayout('auth');
        return $this->load('login');
    }

    public function login()
    {
        return "login to panel.";
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
        if($user->validate() && $user->create()){
            return 'success';
        }

        return $this->load('register', [
            'model' => $user
        ]);
    }


}