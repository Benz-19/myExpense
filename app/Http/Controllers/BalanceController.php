<?php

use App\Http\Controllers\Controller;
use App\Models\DB;

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
            $params = [
                ":id" => $id,
                ":bal" => $user_balance,
                ":amt" => $amount
            ];
            $this->db::execute($query, $params);
        } catch (PDOException $e) {
            echo "Error: FAILED TO SET THE USER BALANCE. " . $e->getMessage();
        }
    }

    public  function getBalance($id)
    {
        try {
            $query = "SELECT balance FROM balance WHERE user_id = :id";
            $params = [":id" => $id];

            $result = $this->db::fetchSingleData($query, $params);

            if (empty($result)) {
                return 0.00;
            } else {
                return $result;
            }
        } catch (PDOException $e) {
            echo "Error: FAILED TO GET THE USER BALANCE. " . $e->getMessage();
        }
    }
}
