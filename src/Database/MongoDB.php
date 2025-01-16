<?php


use MongoDB\Client;

class MongoDBConnection
{
  private static $instance = null;
  private $client;
  private $database;

  private function __construct()
  {
    $requiredVars = [
      'MONGO_INITDB_HOST',
      'MONGO_INITDB_PORT',
      'MONGO_INITDB_ROOT_USERNAME',
      'MONGO_INITDB_ROOT_PASSWORD',
      'MONGO_INITDB_DATABASE',
    ];

    foreach ($requiredVars as $var) {
      if (getenv($var) === false || empty(getenv($var))) {
        throw new \RuntimeException("Environment variable '$var' is not set.");
      }
    }

    $host = getenv('MONGO_INITDB_HOST') ?: 'mongodb';
    $port = getenv('MONGO_INITDB_PORT') ?: '27017';
    $username = getenv('MONGO_INITDB_ROOT_USERNAME');
    $password = getenv('MONGO_INITDB_ROOT_PASSWORD');
    $databaseName = getenv('MONGO_INITDB_DATABASE');

    $uri = "mongodb://$username:$password@$host:$port";

    try {
      $this->client = new Client($uri);
      $this->database = $this->client->selectDatabase($databaseName);

      // Automatically create the database if it does not exist
      $this->createDefaultDatabase();
    } catch (Exception $e) {
      echo "General error: " . $e->getMessage();
      exit;
    }
  }

  // Singleton pattern to ensure a single instance
  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  // Get the MongoDB client
  public function getClient()
  {
    return $this->client;
  }

  // Get the MongoDB database
  public function getDatabase()
  {
    return $this->database;
  }

  // Create the default database if it does not exist
  private function createDefaultDatabase()
  {
    // MongoDB creates databases lazily. To ensure the database is created,
    // we can create a dummy collection and insert a document.
    if (!$this->databaseExists($this->database->getDatabaseName())) {
      $this->database->createCollection('init');
      $this->database->init->insertOne(['init' => true]);
      echo "MongoDB database '{$this->database->getDatabaseName()}' created successfully.\n";
    }
  }

  // Check if a database exists
  private function databaseExists($dbname)
  {
    $databases = $this->client->listDatabases();
    foreach ($databases as $db) {
      if ($db->getName() === $dbname) {
        return true;
      }
    }
    return false;
  }

  // Prevent cloning and unserialization
  public function __clone() {}
  public function __wakeup() {}
}
