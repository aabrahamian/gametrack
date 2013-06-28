<?php

namespace GameTrack\Address;
use Doctrine\Common\Cache\FilesystemCache;

class AddressFSModel 
{
	protected $storage;
	
	public function __construct()
	{
		$storage = new FilesystemCache("../storage/address");
		
		$this->storage = $storage;
	}
	
	/**
	 * GET a address.
	 * @param type $addressID
	 * @return array|null
	 */
	public function getAddress($addressID)
	{
		$data = $this->storage->fetch($addressID);
		$data = json_decode($data, true);
		return $data;
	}
	
	/**
	 * POST a address.
	 * @param type $addressID
	 * @return boolean
	 */
	public function createAddress($addressID, $address)
	{
		$data = json_encode($address);
		$returnData = $this->storage->save($addressID, $data);
		return $returnData;
	}
	
	/**
	 * PUT a address.
	 * @param type $addressID
	 * @return boolean
	 */
	public function setAddress($addressID, $address)
	{
		$data = json_encode($address);
		$returnData = $this->storage->save($addressID, $data);
		return $returnData;
	}
	
	/**
	 * DELETE a address.
	 * @param type $addressID
	 * @return boolean
	 */
	public function deleteAddress($addressID)
	{
		$returnData = $this->storage->delete($addressID);
		return $returnData;
	}
	
}