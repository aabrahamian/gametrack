<?php

use GameTrack\Address\AddressController;
use GameTrack\Company\CompanyController;
use GameTrack\Game\GameController;
use GameTrack\GameSession\GameSessionController;
use GameTrack\Person\PersonController;

use Silex\Application;

require_once __DIR__ . "/../../../../vendor/autoload.php";

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