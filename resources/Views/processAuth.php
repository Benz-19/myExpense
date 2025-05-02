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

    $user_type = 'admin'; //default

    if (empty($username) || empty($password) || empty($password) || empty($verifyPassword) || empty($email)) {
        $messageService::errorMesssage("Failed to get the read the data successfully!!!");
    } else {
        if ($password !== $verifyPassword) {
            $messageService::errorMesssage("Ensure passwords are similar!!!");
        } else {
            // detemine if the user exists
            if (empty($user->fetchUserData((string)$email))) {
                $user->register((string)$username, (string)$password, (string)$email, (string)$user_type);
                $messageService::successMessage("Account was created successfully!!! Returning ...");
            } else {
                $messageService::errorMesssage("User already exists... Returning...");
            }
        }
    }
}
