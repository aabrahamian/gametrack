<?php

class PersonMockModel 
{
	protected $persons;
	
	public function __construct()
	{
		$this->persons = array(
			"1" => array(
				'personID' => "1",
				'firstName' => "Joe",
				'lastName' => "Schmoe",
				'address' => array(
					 array('addressID' => 4),
				),
			),
			"2" => array(
				'personID' => "2",
				'firstName' => "Jane",
				'lastName' => "Doe",
				'address' => array(
					 array('addressID' => 6),
				),
			),
			"3" => array(
				'personID' => "3",
				'firstName' => "Al",
				'lastName' => "Yankovic",
				'address' => array(
					 array('addressID' => 5),
					 array('addressID' => 3),
				),
			),
			"4" => array(
				'personID' => "4",
				'firstName' => "Alex",
				'lastName' => "Trebek",
				'address' => array(
					 array('addressID' => 5),
				),
			),
			"5" => array(
				'personID' => "5",
				'firstName' => "Robin",
				'lastName' => "Williams",
				'address' => array(
					 array('addressID' => 4),
				),
			),
		);
	}
	
	/**
	 * GET a person.
	 * @param type $personID
	 * @return array|null
	 */
	public function getPerson($personID)
	{
		if(array_key_exists($personID, $this->persons)) {
			return $this->persons[$personID];
		}
		else {
			return null;
		}
	}
	
	/**
	 * POST a person.
	 * @param type $personID
	 * @return boolean
	 */
	public function createPerson($personID)
	{
		return false;
	}
	
	/**
	 * PUT a person.
	 * @param type $personID
	 * @return boolean
	 */
	public function setPerson($personID)
	{
		return false;
	}
	
	/**
	 * DELETE a person.
	 * @param type $personID
	 * @return boolean
	 */
	public function deletePerson($personID)
	{
		return false;
	}
	
}