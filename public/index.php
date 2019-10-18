<?php 
require_once "../vendor/autoload.php";

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Frontend\Controllers\{SiteController, CatalogController};

define("DEBUG", true);

if(DEBUG === true){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$router = new RouteCollector();
$router->controller('/catalog', CatalogController::class);
$router->controller('/', SiteController::class);


try{
    $dispatcher = new Dispatcher($router->getData());
    print $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} catch (Phroute\Exception\HttpRouteNotFoundException $e) {
    print($e);
    die();
} catch (Phroute\Exception\HttpMethodNotAllowedException $e) {
    print($e);
    die();
}