<?php
namespace app\controllers;

use app\core\Application;

class ContactController
{
    public function createContact()
    {
        return Application::$app->router->renderView('contact');
    }
    public function SaveContact()
    {
        return "save Contact";
    }

}