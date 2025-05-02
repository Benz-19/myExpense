<?php
session_start();
if (!isset($_SESSION['user_state'])) {
    header("Location: /myExpense/login");
    exit;
}

use App\Http\Controllers\BalanceController;
use App\Services\messageService;

require_once __DIR__ . "/../../vendor/autoload.php";


$userBalance = new BalanceController();
$messageService = new messageService();
if (isset($_POST['sendAmount'])) {
    $amount = $_POST['amount'];
    if (empty($amount)) {
        $messageService::errorMesssage("Enter a valid amount to Update...");
    }
    $result =  $userBalance->setBalance($amount, $_SESSION['user_details']['user_id']); //Update the account
    if ($result) {
        $messageService::successMessage("Acount got updated...");
    }
}
