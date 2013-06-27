<?php

//use JDesrosiers\Service\Cart\CartControllerProvider;
//use JDesrosiers\Service\Cart\CartServiceProvider;
use Silex\Application;

require_once __DIR__ . "/../../../../vendor/autoload.php";
require_once __DIR__ . "/../include.php";

//initialize app
$app = new Application();
$app["debug"] = true;
//
//// Add controllers
//$app->register(new CartServiceProvider());
$app->mount("/address", new AddressController());
$app->mount("/company", new CompanyController());
$app->mount("/game", new GameController());
$app->mount("/gamesession", new GameSessionController());
$app->mount("/person", new PersonController());

//
//// Handle request
$app->run();