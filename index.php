<?php

require_once 'Config/config.php';
require_once 'Autoloader.php';

use App\Autoloader;
use App\Service\Router;
use App\Controller\front\HomeController;

Autoloader::$folderList =
    [
        "App/Model/",
        "App/Controller/front/",
        "App/Controller/back/",
        "App/Repository/",
        "App/Service/",
        "App/Form/",
        "App/Validator/",
    ];
Autoloader::register();

session_start();

try {

    $router = new Router($_GET['url']);

    // HOME
    $router->get('/', function () {
        echo (new HomeController)->invoke();
    });

    // ARTICLE
    $router->get('/article/:id', function ($id) {
        var_dump($id);
        echo (new \App\Controller\front\ArticleController())->show($id);
    });

    $router->run();
} catch (Exception $e) {
    die('Error: ' . $e);
}