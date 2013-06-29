<?php

namespace GameTrack\Company;

use GameTrack\Util\SuperController;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		$this->model = new CompanyFSModel();
		
		$company = $app["controllers_factory"];
		
		$company->get("/{companyID}", array($this, "getCompany"));
//		$company->post("/", array($this, "createCompany"));
		$company->put("/{companyID}", array($this, "setCompany"));
//		$company->delete("/{companyID}", array($this, "deleteCompany"));

		//use for first time setup
		$company->post("/setup", array($this, "loadIntoPersistence"));
		
		return $company;
	}
	
	public function loadIntoPersistence(Request $request)
	{
		$oracle = new CompanyMockModel();
		$data = $oracle->getAll();
		foreach ($data as $id => $value) {
			$this->model->setCompany($id, $value);
		}
		
		$response = new Response(null, 204);
		
		return $response;
	}
	
	public function getCompany(Request $request, $companyID)
	{
		$responseData = $this->model->getCompany($companyID);
		
		//if the content depth is greater than 1, grab lower level subrequests
		$contentDepth = $request->headers->get("Content-Depth");
		if($contentDepth > 0) {
			//for a company, this means grabbing the address, and any games
			//sublevel address
			$resourcePath = "/address/{$responseData['address']['addressID']}";
			$responseData['address'] = $this->grabSubResource($resourcePath, $request);
			
			//sublevel games
			$games = $responseData['game'];
			unset($responseData['game']);
			
			foreach ($games as $game) {
				$resourcePath = "/game/{$game['gameID']}";
				$responseData['game'][] = $this->grabSubResource($resourcePath, $request);
			}
		}
		
		$responseData = json_encode($responseData);
		$response = new Response($responseData, 200);
//		$response->setSharedMaxAge(120);
//		$response->setPublic();
		
		return $response;
	}
	
	public function setCompany(Request $request, $companyID)
	{
		$newCompanyContent = $request->getContent();
		$newCompanyContent = json_decode($newCompanyContent, true);
		
		$responseData = $this->model->setCompany($companyID, $newCompanyContent);
		
		$response = new Response(null, 204);
		
		return $response;
	}
}

