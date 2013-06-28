<?php

namespace GameTrack\GameSession;

class GameSessionMockModel 
{
	protected $gamesessions;
	
	public function __construct()
	{
		$this->gamesessions = array(
			"1" => array(
				'gamesessionID' => "1",
				'address' => array('addressID' => 4),
				'game' => array('gameID' => 1),
				'player' => array(
					 array('personID' => 1),
					 array('personID' => 2),
					 array('personID' => 3),
					 array('personID' => 4),
					 array('personID' => 5),
				),
				'winner' => array(
					 array('personID' => 3),
					 array('personID' => 2),
				),
				 'startTime' => "2013-06-10 18:00:00",
				 'endTime' => "2013-06-10 19:00:00",
			),
			"2" => array(
				'gamesessionID' => "2",
				'address' => array('addressID' => 1),
				'game' => array('gameID' => 3),
				'player' => array(
					 array('personID' => 4),
				),
				'winner' => array(
					 array('personID' => 4),
				),
				 'startTime' => "2013-06-10 18:00:00",
				 'endTime' => "2013-06-10 19:00:00",
			),
			"3" => array(
				'gamesessionID' => "3",
				'address' => array('addressID' => 6),
				'game' => array('gameID' => 2),
				'player' => array(
					 array('personID' => 1),
					 array('personID' => 3),
					 array('personID' => 5),
				),
				'winner' => array(
					 array('personID' => 3),
				),
				 'startTime' => "2013-06-10 18:00:00",
				 'endTime' => "2013-06-10 19:00:00",
			),
		);
	}
	
	public function getAll()
	{
		return $this->gamesessions;
	}
	
	/**
	 * GET a gamesession.
	 * @param type $gamesessionID
	 * @return array|null
	 */
	public function getGameSession($gamesessionID)
	{
		if(array_key_exists($gamesessionID, $this->gamesessions)) {
			return $this->gamesessions[$gamesessionID];
		}
		else {
			return null;
		}
	}
	
	/**
	 * POST a gamesession.
	 * @param type $gamesessionID
	 * @return boolean
	 */
	public function createGameSession($gamesessionID)
	{
		return false;
	}
	
	/**
	 * PUT a gamesession.
	 * @param type $gamesessionID
	 * @return boolean
	 */
	public function setGameSession($gamesessionID)
	{
		return false;
	}
	
	/**
	 * DELETE a gamesession.
	 * @param type $gamesessionID
	 * @return boolean
	 */
	public function deleteGameSession($gamesessionID)
	{
		return false;
	}
	
}