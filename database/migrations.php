<?php

use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$config = include_once __DIR__.'/../config/config.php';

$app = new Application(dirname(__DIR__),$config);


$app->db->applyMigrations();