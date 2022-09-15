<?php


require_once 'config/config.php';
require_once 'Autoloader.php';

use App\Autoloader;
use App\Service\Router;
use App\Controller\front\HomeController;

Autoloader::$folderList =
    [
        "App/Model/",
        "App/Controller/front/",
        "App/Repository/",
        "App/Service/",
        "App/Form/",
        "App/Validator/",
    ];
Autoloader::register();

session_start();

try {

    $router = new Router($_GET['url']);

    $router->get('/', function (){
        echo (new HomeController)->invoke();
    });

    $router->run();
} catch (Exception $e) {
    die('Error: ' . $e);
}