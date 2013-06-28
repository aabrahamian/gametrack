<?php

namespace GameTrack\Game;
use Doctrine\Common\Cache\FilesystemCache;

class GameFSModel 
{
	protected $storage;
	
	public function __construct()
	{
		$storage = new FilesystemCache("../storage/game");
		
		$this->storage = $storage;
	}
	
	/**
	 * GET a game.
	 * @param type $gameID
	 * @return array|null
	 */
	public function getGame($gameID)
	{
		$data = $this->storage->fetch($gameID);
		$data = json_decode($data, true);
		return $data;
	}
	
	/**
	 * POST a game.
	 * @param type $gameID
	 * @return boolean
	 */
	public function createGame($gameID, $game)
	{
		$data = json_encode($game);
		$returnData = $this->storage->save($gameID, $data);
		return $returnData;
	}
	
	/**
	 * PUT a game.
	 * @param type $gameID
	 * @return boolean
	 */
	public function setGame($gameID, $game)
	{
		$data = json_encode($game);
		$returnData = $this->storage->save($gameID, $data);
		return $returnData;
	}
	
	/**
	 * DELETE a game.
	 * @param type $gameID
	 * @return boolean
	 */
	public function deleteGame($gameID)
	{
		$returnData = $this->storage->delete($gameID);
		return $returnData;
	}
	
}