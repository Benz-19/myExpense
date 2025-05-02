<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\DB;
use PDOException;

class ExpenseController extends Controller
{

    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function insertExpense($data = [])
    {
        try {
            $user_id = $data['user_id'];
            $category = $data['category'];
            $description = $data['description'];
            $date = $data['date'];
            $price = $data['price'];

            $query = "INSERT INTO expenses (user_id, category, description, date, price) VALUES (:id, :category, :descpt, :date, :price)";
            $params = [
                ":id" => $user_id,
                ":category" => $category,
                ":descpt" => $description,
                ":date" => $date,
                ":price" => $price
            ];

            $this->db::execute($query, $params);
        } catch (PDOException $e) {
            echo "Error: FAILED TO INSERT THE EXPENSE " . $e->getMessage();
        }
    }
}
