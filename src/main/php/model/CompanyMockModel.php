<?php

class CompanyMockModel 
{
	protected $companies;
	
	public function __construct()
	{
		$this->companies = array(
			"1" => array(
				'companyID' => "1",
				'name' => "Company 1",
				'address' => array('addressID' => 1),
				'game' => array(
					 array('gameID' => 1),
					 array('gameID' => 3),
				),
			),
			"2" => array(
				'companyID' => "1",
				'name' => "Company 2",
				'address' => array('addressID' => 2),
				'game' => array(
					 array('gameID' => 3),
				),
			),
			"3" => array(
				'companyID' => "1",
				'name' => "Company 3",
				'address' => array('addressID' => 3),
				'game' => array(
					 array('gameID' => 2),
				),
			),
		);
	}
	
	/**
	 * GET a company.
	 * @param type $companyID
	 * @return array|null
	 */
	public function getCompany($companyID)
	{
		if(array_key_exists($companyID, $this->companies)) {
			return $this->companies[$companyID];
		}
		else {
			return null;
		}
	}
	
	/**
	 * POST a company.
	 * @param type $companyID
	 * @return boolean
	 */
	public function createCompany($companyID)
	{
		return false;
	}
	
	/**
	 * PUT a company.
	 * @param type $companyID
	 * @return boolean
	 */
	public function setCompany($companyID)
	{
		return false;
	}
	
	/**
	 * DELETE a company.
	 * @param type $companyID
	 * @return boolean
	 */
	public function deleteCompany($companyID)
	{
		return false;
	}
	
}