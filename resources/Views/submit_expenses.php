<?php
if (!isset($_SESSION['user_state'])) {
    header('Location: /myExpense/login');
    exit;
}
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Services\messageService;


$user = new UserController();
$userExpense = new ExpenseController();
$messageService = new messageService();
// Determine number of expenses (assume sent as hidden input or infer from POST keys)
$counter = 0;
$expensesList = [];

while (isset($_POST["category_$counter"])) {

    $expensesList['user_id'] = $_SESSION['user_details']['user_id'];
    $expensesList['category'] = $_POST["category_$counter"];
    $expensesList['description'] = $_POST["description_$counter"];
    $expensesList['date'] = $_POST["date_$counter"];
    $expensesList['price'] = $_POST["price_$counter"];

    $userExpense->insertExpense($expensesList); //Inserts the current expense index at a time
    $expensesList = [];
    $counter++;
}

//Display success message and return
$_SESSION['success_message'] = $messageService::successMessage("Congratulations, your expenses got updated...\n--------- Redirecting ---------");
   
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
