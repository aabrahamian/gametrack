<?php

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class GameController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		
		$game = $app["controllers_factory"];
		
		$game->get("/{gameID}", array($this, "getGame"));
//		$game->post("/", array($this, "createGame"));
//		$game->put("/{gameID}", array($this, "setGame"));
//		$game->delete("/{gameID}", array($this, "deleteGame"));

		return $game;
	}
	
	public function getGame($gameID)
	{
		$model = new GameMockModel();
		
		$responseData = $model->getGame($gameID);
		
		$responseData = json_encode($responseData);
		
		$response = new Response($responseData, 200, array("X-CRAZY-HEADER" => "Alex"));
		
		return $response;
	}
}

