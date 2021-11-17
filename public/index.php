<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';


$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']) ;
$baseUrl = 'http://'.$_SERVER['HTTP_HOST'] . $baseDir;

define('BASE_URL', $baseUrl);

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$dotenv = \Dotenv\Dotenv::createImmutable( $dir = __DIR__ . '/..' );
$dotenv->safeLoad();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$route = empty($_GET['route']) ? '/' : $_GET['route'];

use Phroute\Phroute\RouteCollector;
//use App\Controllers;

$router = new RouteCollector();

$router->controller('/', App\Controllers\IndexController::class);
$router->controller('/admin', App\Controllers\Admin\IndexController::class);
$router->controller('/admin/posts', App\Controllers\Admin\PostsController::class);


$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;
