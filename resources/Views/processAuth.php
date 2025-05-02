<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Http\Controllers\UserController;
use App\Services\messageService;




$user = new UserController();
$messageService = new messageService();
//--- REGISTRATION
if (isset($_POST['submitRegistration'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verifyPassword'];
    $email = $_POST['email'];

    $user_type = 'user'; //default
    $url = '/myExpense/sign-up';  // for registration, url = /sign-up

    if (empty($username) || empty($password) || empty($password) || empty($verifyPassword) || empty($email)) {
        $messageService::errorMesssage("Failed to get the read the data successfully;", $url);
        // header("Location /landing");
        // exit;
    } else {
        if ($password !== $verifyPassword) {
            $messageService::errorMesssage("Ensure passwords are similar", $url);
        } else {
            $user->register((string)$username, (string)$password, (string)$email, (string)$user_type);
        }
    }
}
