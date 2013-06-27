<?php

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameSessionController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		
		$gamesession = $app["controllers_factory"];
		
		$gamesession->get("/{gamesessionID}", array($this, "getGameSession"));
//		$gamesession->post("/", array($this, "createGameSession"));
//		$gamesession->put("/{gamesessionID}", array($this, "setGameSession"));
//		$gamesession->delete("/{gamesessionID}", array($this, "deleteGameSession"));

		return $gamesession;
	}
	
	public function getGameSession(Request $request, $gamesessionID)
	{
		$model = new GameSessionMockModel();
		$responseData = $model->getGameSession($gamesessionID);
		
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
			$resourcePath = "/person/{$responseData['address']['addressID']}";
			$responseData['address'] = $this->grabSubResource($resourcePath, $request);
		}
		$responseData['contentdepth'] = $contentDepth;
		
		$responseData = json_encode($responseData);
		$response = new Response($responseData, 200, array("X-CRAZY-HEADER" => "Alex"));
		
		return $response;
	}
}

