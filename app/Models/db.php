<?php
//dir app/Models/db.php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use Dotenv\Dotenv;

require_once __DIR__ . "/../../vendor/autoload.php";


class DB
{
    private $username;
    private $password;
    private $host;
    private $dbname;
    protected $conn;


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
        try {
            $dsn = "mysql:host={$this->host}, dbname={$this->dbname}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "DB Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }

    //SQL Query execution
    static function execute(string $query,  $params = [])
    {
        $sql = self::connection()->prepare($query);
        return $sql->execute($params);
    }

    //SQL Query fetch a single data
    static function fetchSingleData(string $query,  $params = [])
    {
        $sql = self::connection()->prepare($query);
        $sql->execute($params);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //SQL Query fetch all data
    static function fetchAllData(string $query,  $params = [])
    {
        $sql = self::connection()->prepare($query);
        $sql->execute($params);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
