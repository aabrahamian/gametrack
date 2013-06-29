<?php

use GameTrack\Address\AddressController;
use GameTrack\Company\CompanyController;
use GameTrack\Game\GameController;
use GameTrack\GameSession\GameSessionController;
use GameTrack\Person\PersonController;

use Silex\Application;
use Silex\Provider\HttpCacheServiceProvider;

require_once __DIR__ . "/../../../../vendor/autoload.php";

date_default_timezone_set('America/Los_Angeles');

//initialize app
$app = new Application();
$app["debug"] = true;
$app->register(new HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => __DIR__.'/../cache/',
	 "http_cache.esi" => null,
    "http_cache.options" => array(
        "debug" => true,
        "allow_reload" => true,
        "allow_revalidate" => true,
//        "default_ttl" => 120,
    ),
));

//// Add controllers
$app->mount("/address", new AddressController());
$app->mount("/company", new CompanyController());
$app->mount("/game", new GameController());
$app->mount("/gamesession", new GameSessionController());
$app->mount("/person", new PersonController());

//
//// Handle request
$app['http_cache']->run();