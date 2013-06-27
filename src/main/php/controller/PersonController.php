<?php

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		
		$person = $app["controllers_factory"];
		
		$person->get("/{personID}", array($this, "getPerson"));
//		$person->post("/", array($this, "createPerson"));
//		$person->put("/{personID}", array($this, "setPerson"));
//		$person->delete("/{personID}", array($this, "deletePerson"));

		return $person;
	}
	
	public function getPerson(Request $request, $personID)
	{
		$model = new PersonMockModel();
		
		$responseData = $model->getPerson($personID);
		
		$contentDepth = $request->headers->get("Content-Depth");
		
		//if the content depth is greater than 1, grab lower level subrequests
		if($contentDepth > 0) {
			$addresses = $responseData['address'];
			unset($responseData['address']);
			//for a person, this means grabbing the address
			foreach ($addresses as $address) {
				$resourcePath = "/address/{$address['addressID']}";
				$responseData['address'][] = $this->grabSubResource($resourcePath, $request);
			}
		}
		$responseData['contentdepth'] = $contentDepth;
		
		$responseData = json_encode($responseData);
		$response = new Response($responseData, 200, array("X-CRAZY-HEADER" => "Alex"));
		
		return $response;
	}
}

