<?php

define('ROOT', dirname(__FILE__));

require_once 'system/autoload.php';

$router = new System\Router();
$router->run();
