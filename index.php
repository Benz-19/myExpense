<?php
if(!session_start()){
    session_start();
}
$request = $_SERVER['REQUEST_URI'];

$request = str_replace('/myExpense', '', $request); //replaces the default url with '/'

$viewDir = '/resources/Views/';

switch ($request) {
        case '':
        case '/':
            require __DIR__ . $viewDir . 'landing.php';
            break;
        case '/dashboard':
            require __DIR__ . $viewDir . 'dashboard.php';
            break;
        case '/login':
            require __DIR__ . $viewDir . 'login.php';
            break;
        case '/sign-up':
            require __DIR__ . $viewDir . 'signup.php';
            break;
        case '/processAuth':
            require __DIR__ . $viewDir . 'processAuth.php';
            break;
        case '/submit_expenses':
            require __DIR__ . $viewDir . 'submit_expenses.php';
            break;
        case '/get_expenses':
            require __DIR__ . $viewDir . 'get_expenses.php';
            break;
        case '/logout':
            require __DIR__ . $viewDir . 'logout.php';
            break;
        default:
            require __DIR__ . $viewDir . '404.php';
            break;
}

?>
