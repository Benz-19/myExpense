<?php

$request = $_SERVER['REQUEST_URI'];

echo $request;
$viewDir = '/resources/Views/';
switch ($request) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'landing.php';
        break;
    default:
        require __DIR__ . $viewDir . '404.php';
        break;
}
