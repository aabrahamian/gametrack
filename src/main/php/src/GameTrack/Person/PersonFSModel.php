<?php

namespace GameTrack\Person;
use Doctrine\Common\Cache\FilesystemCache;

class PersonFSModel 
{
	protected $storage;
	
	public function __construct()
	{
		$storage = new FilesystemCache("../storage/person");
		
		$this->storage = $storage;
	}
	
	/**
	 * GET a person.
	 * @param type $personID
	 * @return array|null
	 */
	public function getPerson($personID)
	{
		$data = $this->storage->fetch($personID);
		$data = json_decode($data, true);
		return $data;
	}
	
	/**
	 * POST a person.
	 * @param type $personID
	 * @return boolean
	 */
	public function createPerson($personID, $person)
	{
		$data = json_encode($person);
		$returnData = $this->storage->save($personID, $data);
		return $returnData;
	}
	
	/**
	 * PUT a person.
	 * @param type $personID
	 * @return boolean
	 */
	public function setPerson($personID, $person)
	{
		$data = json_encode($person);
		$returnData = $this->storage->save($personID, $data);
		return $returnData;
	}
	
	/**
	 * DELETE a person.
	 * @param type $personID
	 * @return boolean
	 */
	public function deletePerson($personID)
	{
		$returnData = $this->storage->delete($personID);
		return $returnData;
	}
	
}