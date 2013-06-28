<?php

namespace GameTrack\Game;

use GameTrack\Util\SuperController;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class GameController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		$this->model = new GameFSModel();
		
		$game = $app["controllers_factory"];
		
		$game->get("/{gameID}", array($this, "getGame"));
//		$game->post("/", array($this, "createGame"));
		$game->put("/{gameID}", array($this, "setGame"));
//		$game->delete("/{gameID}", array($this, "deleteGame"));
		
		//use for first time setup
		$game->post("/setup", array($this, "loadIntoPersistence"));

		return $game;
	}
	
	public function loadIntoPersistence(Request $request)
	{
		$oracle = new GameMockModel();
		$data = $oracle->getAll();
		foreach ($data as $id => $value) {
			$this->model->setGame($id, $value);
		}
		
		$response = new Response(null, 204);
		
		return $response;
	}
	
	public function getGame(Request $request, $gameID)
	{
		$responseData = $this->model->getGame($gameID);
		
		$responseData = json_encode($responseData);
		
		$response = new Response($responseData, 200);
		
		return $response;
	}
	
	public function setGame(Request $request, $gameID)
	{
		$newGameContent = $request->getContent();
		$newGameContent = json_decode($newGameContent, true);
		
		$responseData = $this->model->setGame($gameID, $newGameContent);
		
		$response = new Response(null, 204);
		
		return $response;
	}
}

