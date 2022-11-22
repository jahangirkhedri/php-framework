<?php

namespace app\controllers;

use app\core\Request;
use app\Model\RegisterModel;

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
        $registerModel = new RegisterModel();
        $registerModel->loadData($request->getBody());
        if($registerModel->validate() && $registerModel->create()){
            return 'success';
        }

        return $this->load('register', [
            'model' => $registerModel
        ]);
    }


}