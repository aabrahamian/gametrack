<?php

class GameMockModel 
{
	protected $games;
	
	public function __construct()
	{
		$this->games = array(
			"1" => array(
				'gameID' => "1",
				'name' => "The Resistance",
				'description' => "Social Deduction Game",
				'type' => "board",
			),
			"2" => array(
				'gameID' => "2",
				'name' => "Settlers of Catan",
				'description' => "Settlement building game",
				'type' => "board",
			),
			"3" => array(
				'gameID' => "3",
				'name' => "Braid",
				'description' => "Time control platformer",
				'type' => "computer",
			),
		);
	}
	
	/**
	 * GET a game.
	 * @param type $gameID
	 * @return array|null
	 */
	public function getGame($gameID)
	{
		if(array_key_exists($gameID, $this->games)) {
			return $this->games[$gameID];
		}
		else {
			return null;
		}
	}
	
	/**
	 * POST a game.
	 * @param type $gameID
	 * @return boolean
	 */
	public function createGame($gameID)
	{
		return false;
	}
	
	/**
	 * PUT a game.
	 * @param type $gameID
	 * @return boolean
	 */
	public function setGame($gameID)
	{
		return false;
	}
	
	/**
	 * DELETE a game.
	 * @param type $gameID
	 * @return boolean
	 */
	public function deleteGame($gameID)
	{
		return false;
	}
	
}