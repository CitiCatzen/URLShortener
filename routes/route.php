<?php

use Configs\Database;
use Controllers\URLController;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$database = new Database();
$db = $database->getConnection();
$controller = new URLController($db);

if (explode('/', $_SERVER['REQUEST_URI'])[1] == 'api') {
    require_once __DIR__ . '/api.php';
} else {
    require_once __DIR__ . '/web.php';
}
