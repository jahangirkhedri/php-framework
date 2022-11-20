<?php

namespace app\controllers;

use app\core\Application;

class HomeController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'jahan'
        ];
        return $this->render('home',$params);
    }

}