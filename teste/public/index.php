<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../utils/response.php';
require_once __DIR__ . '/../routes/Router.php';

use Routes\Router;

header("Content-Type: application/json");

$router = new Router();
$router->dispatch();
?>