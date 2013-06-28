<?php

namespace GameTrack\GameSession;
use Doctrine\Common\Cache\FilesystemCache;

class GameSessionFSModel 
{
	protected $storage;
	
	public function __construct()
	{
		$storage = new FilesystemCache("../storage/gamesession");
		
		$this->storage = $storage;
	}
	
	/**
	 * GET a gamesession.
	 * @param type $gamesessionID
	 * @return array|null
	 */
	public function getGameSession($gamesessionID)
	{
		$data = $this->storage->fetch($gamesessionID);
		$data = json_decode($data, true);
		return $data;
	}
	
	/**
	 * POST a gamesession.
	 * @param type $gamesessionID
	 * @return boolean
	 */
	public function createGameSession($gamesessionID, $gamesession)
	{
		$data = json_encode($gamesession);
		$returnData = $this->storage->save($gamesessionID, $data);
		return $returnData;
	}
	
	/**
	 * PUT a gamesession.
	 * @param type $gamesessionID
	 * @return boolean
	 */
	public function setGameSession($gamesessionID, $gamesession)
	{
		$data = json_encode($gamesession);
		$returnData = $this->storage->save($gamesessionID, $data);
		return $returnData;
	}
	
	/**
	 * DELETE a gamesession.
	 * @param type $gamesessionID
	 * @return boolean
	 */
	public function deleteGameSession($gamesessionID)
	{
		$returnData = $this->storage->delete($gamesessionID);
		return $returnData;
	}
	
}