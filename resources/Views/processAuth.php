<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

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
    $user = new UserController();
    $messageService = new messageService();
    $username = $_POST['name'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verifyPassword'];
    $email = $_POST['email'];

    $user_type = 'user'; //default

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

// LOGIN
function processLogin()
{
    $user = new UserController();
    $messageService = new messageService();
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $messageService::errorMesssage("Ensure all fields are filled completely...");
    } else {
        $userData = $user->fetchUserData((string) $email);

        // Check if the user exists
        if (empty($userData)) {
            $messageService::errorMesssage("User already exists...\nCreate a new Account\n\tReturning...");
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
                $_SESSION['user_details'] = $currentUserData;
                header("Location: /myExpense/dashboard");
                exit;
            } else {
                $messageService::errorMesssage("Incorrect password.");
            }
        }
    }
}



function test()
{
    return "hello";
}
