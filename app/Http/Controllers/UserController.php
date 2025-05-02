<?php

declare(strict_types=1);

namespace App\Http\UserControllers;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Models/db.php';

use PDOException;
use App\Models\DB;
use App\Http\Controllers\Controller;


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

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $params = [
                ":name" => $name,
                ":password" => $hashed_password,
                ":email" => $email,
                ":type" => $type
            ];

            $this->db::execute($query, $params);
        } catch (PDOException $e) {
            echo "USER REGISTRATION ERROR: " . $e->getMessage();
        }
    }
}
