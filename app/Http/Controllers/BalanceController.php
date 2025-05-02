<?php

namespace App\Http\Controllers;

use PDOException;
use App\Models\DB;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function setBalance($amount, $id)
    {

        try {
            $user_balance = $this->getBalance($id);

            $query = "INSERT INTO balance (user_id, balance, amount) VALUES (:id, :bal, :amt)";
            $newBalance = (float)$user_balance + (float)$amount;
            $params = [
                ":id" => $id,
                ":bal" => $newBalance,
                ":amt" => $amount
            ];
            $this->db::execute($query, $params);

            return true;
        } catch (PDOException $e) {
            echo "Error: FAILED TO SET THE USER BALANCE. " . $e->getMessage();
            return false;
        }
    }

    public  function getBalance($id)
    {
        try {
            $query = "SELECT balance FROM balance WHERE user_id = :id ORDER BY balance DESC LIMIT 1";
            $params = [":id" => $id];

            $result = $this->db::fetchSingleData($query, $params);

            if (empty($result)) {
                return 0.00;
            } else {
                return $result['balance'];
            }
        } catch (PDOException $e) {
            echo "Error: FAILED TO GET THE USER BALANCE. " . $e->getMessage();
        }
    }
}
