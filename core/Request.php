<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $positions = strpos($path, '?');

        if ($positions === false)
            return $path;

        return substr($path, 0, $positions);
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}