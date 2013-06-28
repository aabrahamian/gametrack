<?php

namespace GameTrack\Address;

use GameTrack\Util\SuperController;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		$this->model = new AddressFSModel();
		
		$address = $app["controllers_factory"];
		
		$address->get("/{addressID}", array($this, "getAddress"));
//		$address->post("/", array($this, "createAddress"));
		$address->put("/{addressID}", array($this, "setAddress"));
//		$address->delete("/{addressID}", array($this, "deleteAddress"));
		
		//use for first time setup
		$address->post("/setup", array($this, "loadIntoPersistence"));

		return $address;
	}
	
	public function loadIntoPersistence(Request $request)
	{
		$oracle = new AddressMockModel();
		$data = $oracle->getAll();
		foreach ($data as $id => $value) {
			$this->model->setAddress($id, $value);
		}
		
		$response = new Response(null, 204);
		
		return $response;
	}
	
	public function getAddress(Request $request, $addressID)
	{
		$contentDepth = $request->headers->get("Content-Depth");
		
		$responseData = $this->model->getAddress($addressID);
		
		$responseData = json_encode($responseData);
		
		$response = new Response($responseData, 200);
		
		return $response;
	}
	
	public function setAddress(Request $request, $addressID)
	{
		$newAddressContent = $request->getContent();
		$newAddressContent = json_decode($newAddressContent, true);
		
		$responseData = $this->model->setAddress($addressID, $newAddressContent);
		
		$response = new Response(null, 204);
		
		return $response;
	}
}

