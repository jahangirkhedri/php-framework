<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;

class ContactController extends Controller
{
    public function createContact()
    {
       return $this->load('contact');
    }

    public function SaveContact(Request $request)
    {
        $body = $request->getBody();
        return "save Contact";
    }

}