<?php

class TestController
{
  public function testMongo()
  {
    try {
      $mongo = MongoDBConnection::getInstance();
      $db = $mongo->getDatabase();
      $collections = $db->listCollections();

      echo "<h2>MongoDB Connection Successful!</h2>";
      echo "<p>Connected to database: " . htmlspecialchars($db->getDatabaseName()) . "</p>";
      echo "<h3>Collections:</h3><ul>";

      foreach ($collections as $collection) {
        echo "<li>" . htmlspecialchars($collection->getName()) . "</li>";
      }

      echo "</ul>";
    } catch (Exception $e) {
      echo "MongoDB Connection Test Failed: " . $e->getMessage();
    }
  }
}
