<?php

namespace GameTrack\Address;

class AddressMockModel 
{
	protected $addresses;
	
	public function __construct()
	{
		$this->addresses = array(
			"1" => array(
				'addressID' => "1",
				'street1' => "12234 Made Up Lane",
				'city' => "SLO",
				'state' => "CA",
			),
			"2" => array(
				'addressID' => "2",
				'street1' => "2345 Made Up Lane",
				'city' => "SLO",
				'state' => "CA",
			),
			"3" => array(
				'addressID' => "3",
				'street1' => "3456 Made Up Lane",
				'city' => "SLO",
				'state' => "CA",
			),
			"4" => array(
				'addressID' => "4",
				'street1' => "4567 Made Up Lane",
				'city' => "SLO",
				'state' => "CA",
			),
			"5" => array(
				'addressID' => "5",
				'street1' => "5678 Made Up Lane",
				'city' => "SLO",
				'state' => "CA",
			),
			"6" => array(
				'addressID' => "6",
				'street1' => "6789 Made Up Lane",
				'city' => "SLO",
				'state' => "CA",
			),
		);
	}
	
	public function getAll()
	{
		return $this->addresses;
	}
	
	/**
	 * GET a address.
	 * @param type $addressID
	 * @return array|null
	 */
	public function getAddress($addressID)
	{
		if(array_key_exists($addressID, $this->addresses)) {
			return $this->addresses[$addressID];
		}
		else {
			return null;
		}
	}
	
	/**
	 * POST a address.
	 * @param type $addressID
	 * @return boolean
	 */
	public function createAddress($addressID)
	{
		return false;
	}
	
	/**
	 * PUT a address.
	 * @param type $addressID
	 * @return boolean
	 */
	public function setAddress($addressID)
	{
		return false;
	}
	
	/**
	 * DELETE a address.
	 * @param type $addressID
	 * @return boolean
	 */
	public function deleteAddress($addressID)
	{
		return false;
	}
	
}