<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\UserController;
use App\Services\messageService;


if (isset($_POST['submitRegistration'])) {
    processRegistration();
} else {
    processLogin();
}

//--- REGISTRATION
function processRegistration()
{
   // session_start();
    $user = new UserController();
    $messageService = new messageService();
    $username = $_POST['name'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verifyPassword'];
    $email = $_POST['email'];

    $user_type = 'user'; //default

    if (empty($username) || empty($password) || empty($password) || empty($verifyPassword) || empty($email)) {
    $_SESSION['error_message'] = $messageService::errorMesssage("Failed to get the read the data successfully!!!");
    } else {
        if ($password !== $verifyPassword) {
    $_SESSION['error_message'] = $messageService::errorMesssage("Ensure passwords are similar!!!");
        } else {
            // detemine if the user exists
            if (empty($user->fetchUserData((string)$email))) {
                $user->register((string)$username, (string)$password, (string)$email, (string)$user_type);
                $_SESSION['error_message'] = $messageService::successMessage("Account was created successfully!!! Returning ...");
            } else {
                $_SESSION['error_message'] = $messageService::errorMesssage("User already exists... Returning...");
            }
        }
    }
}

// LOGIN
function processLogin()
{
   //session_start();
    $user = new UserController();
    $messageService = new messageService();
    $userBalance = new BalanceController();

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = $messageService::errorMesssage("Ensure all fields are filled completely...");
    } else {
        $userData = $user->fetchUserData((string) $email);

        // Check if the user exists
        if (empty($userData)) {
            $_SESSION['error_message'] = $messageService::errorMesssage("User already exists...\nCreate a new Account\n\tReturning...");
        } else {
            // $dbEmail = $userData['email'];
            $dbpass = $userData[0]['user_password'];

            // store the data in a list for the session
            $currentUserData = [
                'user_id' => $userData[0]['id'],
                'username' => $userData[0]['username'],
                'user_type' => $userData[0]['user_type'],
                'email' => $userData[0]['email']
            ];
            //Authenticate user password
            if (password_verify($password, $dbpass)) {
                $_SESSION['user_state'] = true;
                $currentUserData['balance'] = $userBalance->getBalance($currentUserData['user_id']);
                $_SESSION['user_details'] = $currentUserData;
                header("Location: /myExpense/dashboard");
                exit;
            } else {
               $_SESSION['error_message'] = $messageService::errorMesssage("Incorrect password.");
            }
        }
    }
}

