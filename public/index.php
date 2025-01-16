<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload Composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Define a base path for including files
$baseDir = __DIR__ . '/../src/';

// Import the PDO class
require_once $baseDir . 'Database/Database.php';

// Import the MongoDB class
require_once $baseDir . 'Database/MongoDB.php';

session_start();

$do = 'home';

if (isset($_GET['do'])) {
  $do = $_GET['do'];
}

if ($do != 'login' && $do != 'register' && $do != 'test-mongo' && !isset($_SESSION['user'])) {
  header('Location: /?do=login');
}

switch ($do) {
  case 'home':
    require $baseDir . 'controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
    break;
  case 'register':
    require $baseDir . 'controllers/AuthController.php';
    $controller = new AuthController();
    $controller->register();
    break;
  case 'login':
    require $baseDir . 'controllers/AuthController.php';
    $controller = new AuthController();
    $controller->login();
    break;
  case 'logout':
    session_destroy();
    header('Location: /');
    break;
  case 'test-mongo':
    require $baseDir . 'controllers/TestController.php';
    $controller = new TestController();
    $controller->testMongo();
    break;
  default:
    http_response_code(404);
    echo 'Page not found!';
    break;
}
