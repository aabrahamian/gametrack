<?php

namespace GameTrack\GameSession;

use GameTrack\Util\SuperController;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameSessionController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		$this->model = new GameSessionFSModel();
		
		$gamesession = $app["controllers_factory"];
		
		$gamesession->get("/{gamesessionID}", array($this, "getGameSession"));
//		$gamesession->post("/", array($this, "createGameSession"));
		$gamesession->put("/{gamesessionID}", array($this, "setGameSession"));
//		$gamesession->delete("/{gamesessionID}", array($this, "deleteGameSession"));
		
		//use for first time setup
		$gamesession->post("/setup", array($this, "loadIntoPersistence"));

		return $gamesession;
	}
	
	public function loadIntoPersistence(Request $request)
	{
		$oracle = new GameSessionMockModel();
		$data = $oracle->getAll();
		foreach ($data as $id => $value) {
			$this->model->setGameSession($id, $value);
		}
		
		$response = new Response(null, 204);
		
		return $response;
	}
	
	public function getGameSession(Request $request, $gamesessionID)
	{
		$responseData = $this->model->getGameSession($gamesessionID);
		
		//if the content depth is greater than 1, grab lower level subrequests
		$contentDepth = $request->headers->get("Content-Depth");
		if($contentDepth > 0) {
			//for a gamesession, this means grabbing the game, players, winners, and address
			//sublevel game
			$resourcePath = "/game/{$responseData['game']['gameID']}";
			$responseData['game'] = $this->grabSubResource($resourcePath, $request);
			
			//sublevel players
			$players = $responseData['player'];
			unset($responseData['player']);
			
			foreach ($players as $person) {
				$resourcePath = "/person/{$person['personID']}";
				$responseData['player'][] = $this->grabSubResource($resourcePath, $request);
			}
			
			//sublevel winners
			$winners = $responseData['winner'];
			unset($responseData['winner']);
			
			foreach ($winners as $person) {
				$resourcePath = "/person/{$person['personID']}";
				$responseData['winner'][] = $this->grabSubResource($resourcePath, $request);
			}
			
			//sublevel address
			$resourcePath = "/address/{$responseData['address']['addressID']}";
			$responseData['address'] = $this->grabSubResource($resourcePath, $request);
		}
		
		$responseData = json_encode($responseData);
		$response = new Response($responseData, 200);
//		$response->setSharedMaxAge(120);
//		$response->setPublic();
		
		return $response;
	}
	
	public function setGameSession(Request $request, $gamesessionID)
	{
		$newGameSessionContent = $request->getContent();
		$newGameSessionContent = json_decode($newGameSessionContent, true);
		
		$responseData = $this->model->setGameSession($gamesessionID, $newGameSessionContent);
		
		$response = new Response(null, 204);
		
		return $response;
	}
}

