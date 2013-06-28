<?php

namespace GameTrack\Game;

class GameSQLiteModel 
{
	protected $db;
	
	public function __construct()
	{
		if ($this->db = new SQLiteDatabase('gametrack')) {
			@$db->query('CREATE TABLE IF NOT EXISTS game (gameID int, name text, description text, type text, PRIMARY KEY (gameID))');
		} 
		else {
			 throw new Exception("Could not make sqlite db", 500);
		}
	}
	
	/**
	 * GET a game.
	 * @param type $gameID
	 * @return array|null
	 */
	public function getGame($gameID)
	{
		$result = @$this->db->query('SELECT * FROM game WHERE id = ' . $this->db->sqlite_escape_string($gameID));
		$row = $result->fetchSingle();
		return $row;
	}
	
	/**
	 * POST a game.
	 * @param type $gameID
	 * @return boolean
	 */
	public function createGame($gameID, $game)
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