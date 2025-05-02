<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Models/db.php';

use App\Http\Controllers\Controller;
use App\Models\DB;


/**
 * Class UserController
 * Handles user registration and login
 */

class UserController extends Controller
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function register(string $name, string $password, string $email, string $type)
    {
        try {
            $query = "INSERT INTO users (username, password, email, user_type) VALUES (:name,:password,:email,:type)";
            $params = [
                ":name" => $name,
                ":password" => $password,
                ":email" => $email,
                ":type" => $type
            ];

            $this->db::execute($query, $params);
        } catch (PDOException $e) {
            echo "USER REGISTRATION ERROR: " . $e->getMessage();
        }
    }
}
