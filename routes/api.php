<?php

header("Content-Type: application/json; charset=UTF-8");

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        echo json_encode($controller->store($_REQUEST));
        break;
    case 'GET':
        echo json_encode($controller->show(str_replace('/api/', '', $_SERVER['REQUEST_URI'])));
        break;
}
