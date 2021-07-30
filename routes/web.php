<?php

if ($_POST) {
    $_SESSION['data'] = ($controller->store($_REQUEST));
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/index.php';
