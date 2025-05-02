<?php

use App\Http\UserControllers\UserController;
use App\Services\messageService;

require_once __DIR__ . '/../../app/Helpers/all_inlcudes.php';



$user = new UserController();
$messageService = new messageService();
//--- REGISTRATION
if (isset($_POST['submitRegistration'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verifyPassword'];
    $email = $_POST['email'];

    $user_type = 'user'; //default

    if (empty($username) || empty($password) || empty($password) || empty($verifyPassword) || empty($email)) {
        $messageService::errorMesssage("Failed to get the read the data successfully;");
        // header("Location /landing");
        // exit;
    } else {
        $user->register((string)$username, (string)$password, (string)$email, (string)$user_type);
    }
}
