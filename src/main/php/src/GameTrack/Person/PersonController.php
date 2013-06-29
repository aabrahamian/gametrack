<?php

namespace GameTrack\Person;

use GameTrack\Util\SuperController;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		$this->model = new PersonFSModel();
		
		$person = $app["controllers_factory"];
		
		$person->get("/{personID}", array($this, "getPerson"));
//		$person->post("/", array($this, "createPerson"));
		$person->put("/{personID}", array($this, "setPerson"));
//		$person->delete("/{personID}", array($this, "deletePerson"));
		
		//use for first time setup
		$person->post("/setup", array($this, "loadIntoPersistence"));

		return $person;
	}
	
	public function loadIntoPersistence(Request $request)
	{
		$oracle = new PersonMockModel();
		$data = $oracle->getAll();
		foreach ($data as $id => $value) {
			$this->model->setPerson($id, $value);
		}
		
		$response = new Response(null, 204);
		
		return $response;
	}
	
	public function getPerson(Request $request, $personID)
	{
		$responseData = $this->model->getPerson($personID);
		
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
		
		$responseData = json_encode($responseData);
		$response = new Response($responseData, 200);
//		$response->setSharedMaxAge(120);
//		$response->setPublic();
		
		return $response;
	}
	
	public function setPerson(Request $request, $personID)
	{
		$newPersonContent = $request->getContent();
		$newPersonContent = json_decode($newPersonContent, true);
		
		$responseData = $this->model->setPerson($personID, $newPersonContent);
		
		$response = new Response(null, 204);
		
		return $response;
	}
}

