<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Controllers\UserController;
use App\Services\messageService;


$user = new UserController();
$messageService = new messageService();
// Determine number of expenses (assume sent as hidden input or infer from POST keys)
$counter = 0;
while (isset($_POST["category_$counter"])) {
    $category = $_POST["category_$counter"];
    $description = $_POST["description_$counter"];
    $date = $_POST["date_$counter"];
    $price = $_POST["price_$counter"];

    $stmt = $conn->prepare("INSERT INTO expenses (category, description, date, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $category, $description, $date, $price);
    $stmt->execute();

    $counter++;
}
