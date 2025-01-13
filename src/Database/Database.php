<?php

class Database
{
    // Hold the class instance.
    private static $instance = null;
    private $connection;

    // The constructor is private to prevent initiation with outer code.
    private function __construct()
    {
        // Load env variables using getenv() or a library like phpdotenv
        $requiredVars = [
            'DB_HOST',
            'DB_NAME',
            'DB_USER',
            'DB_PASSWORD',
        ];

        foreach ($requiredVars as $var) {
            if (getenv($var) === false || empty(getenv($var))) {
                throw new \RuntimeException("Environment variable '$var' is not set.");
            }
        }

        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $this->connection = new PDO($dsn, $user, $password);
            // Set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    // Prevent the instance from being cloned
    public function __clone() {}

    // Prevent from being unserialized
    public function __wakeup() {}
}
