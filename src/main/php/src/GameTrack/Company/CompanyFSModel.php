<?php

namespace GameTrack\Company;

use Doctrine\Common\Cache\FilesystemCache;

class CompanyFSModel 
{
	protected $storage;
	
	public function __construct()
	{
		$storage = new FilesystemCache("../storage/company");
		
		$this->storage = $storage;
	}
	
	/**
	 * GET a company.
	 * @param type $companyID
	 * @return array|null
	 */
	public function getCompany($companyID)
	{
		$data = $this->storage->fetch($companyID);
		$data = json_decode($data, true);
		return $data;
	}
	
	/**
	 * POST a company.
	 * @param type $companyID
	 * @return boolean
	 */
	public function createCompany($companyID, $company)
	{
		$data = json_encode($company);
		$returnData = $this->storage->save($companyID, $data);
		return $returnData;
	}
	
	/**
	 * PUT a company.
	 * @param type $companyID
	 * @return boolean
	 */
	public function setCompany($companyID, $company)
	{
		$data = json_encode($company);
		$returnData = $this->storage->save($companyID, $data);
		return $returnData;
	}
	
	/**
	 * DELETE a company.
	 * @param type $companyID
	 * @return boolean
	 */
	public function deleteCompany($companyID)
	{
		$returnData = $this->storage->delete($companyID);
		return $returnData;
	}
	
}