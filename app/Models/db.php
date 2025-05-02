<?php
//dir app/Models/db.php
namespace App\Models;

use Dotenv\Dotenv;

require_once __DIR__ . "/../../vendor/autoload.php";



class DB
{
    private $username;
    private $password;
    private $host;
    private $dbname;
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
    }

    public function connection()
    {
        return $this->dbname;
    }
}
