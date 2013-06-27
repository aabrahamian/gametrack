<?php

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		
		$company = $app["controllers_factory"];
		
		$company->get("/{companyID}", array($this, "getCompany"));
//		$company->post("/", array($this, "createCompany"));
//		$company->put("/{companyID}", array($this, "setCompany"));
//		$company->delete("/{companyID}", array($this, "deleteCompany"));

		return $company;
	}
	
	public function getCompany(Request $request, $companyID)
	{
		$model = new CompanyMockModel();
		$responseData = $model->getCompany($companyID);
		
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
		$responseData['contentdepth'] = $contentDepth;
		
		$responseData = json_encode($responseData);
		$response = new Response($responseData, 200, array("X-CRAZY-HEADER" => "Alex"));
		
		return $response;
	}
}

