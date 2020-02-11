<?php

define('ROOT', dirname(__FILE__));
define('BASE_URL', '/hv/');

require_once 'system/autoload.php';

$router = new System\Router();
$router->run();
