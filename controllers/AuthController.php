<?php

namespace app\controllers;

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

    public function register()
    {
        return "Register is complete.";
    }


}