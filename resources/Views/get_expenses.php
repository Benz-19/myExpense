<?php
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
       $_SESSION['error_message'] =  $messageService::errorMesssage("Enter a valid amount to Update...");
    }
    $result =  $userBalance->setBalance($amount, $_SESSION['user_details']['user_id']); //Update the account
    if ($result) {
       $_SESSION['success_message'] = $messageService::successMessage("Acount got updated...");
    }
}


//Error Message Handler   
if (isset($_SESSION['success_message'])) {
    echo '<script>const msg = true;</script>';
    echo '<div class ="success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var success_msgs = document.querySelectorAll('.success');
    
        if (success_msgs.length > 0) {
            success_msgs.forEach(function(msgElement) {
                msgElement.style.color = 'green';
            });
    
            setTimeout(() => {
                window.history.back(); //redirect to the previous page
            }, 9000);
        }
    });
    </script>
    <?php
}

//Success Message Handler 
if (isset($_SESSION['error_message'])) {
    echo '<div class ="error">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['error_message']);
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var error_msg = document.querySelectorAll('.error');
            if (error_msg.length > 0) {
                error_msg.forEach(function(msgElm){
                    msgElm.style.color = 'red';
                });
                
                setTimeout(() => {
                    window.history.back(); //redirect to the previous page
                }, 9000);
            }
        });
    </script>
    <?php
}

?>
