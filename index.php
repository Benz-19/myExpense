<?php

$request = $_SERVER['REQUEST_URI'];

$request = str_replace('/myExpense', '', $request); //replaces the default url with '/'

echo $request;

$viewDir = '/resources/Views/';
switch ($request) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'landing.php';
        break;
    case '/dashboard/':
        require __DIR__ . $viewDir . 'dashboard.php';
        break;
    default:
        require __DIR__ . $viewDir . '404.php';
        break;
}
