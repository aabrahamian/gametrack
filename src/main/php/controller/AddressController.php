<?php

use Silex\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends SuperController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$this->app = $app;
		
		$address = $app["controllers_factory"];
		
		$address->get("/{addressID}", array($this, "getAddress"));
//		$address->post("/", array($this, "createAddress"));
//		$address->put("/{addressID}", array($this, "setAddress"));
//		$address->delete("/{addressID}", array($this, "deleteAddress"));

		return $address;
	}
	
	public function getAddress(Request $request, $addressID)
	{
		$model = new AddressMockModel();
		
		$contentDepth = $request->headers->get("Content-Depth");
		
		$responseData = $model->getAddress($addressID);
		
		$responseData['contentdepth'] = $contentDepth;
		$responseData = json_encode($responseData);
		
		$response = new Response($responseData, 200, array("X-CRAZY-HEADER" => "Alex"));
		
		return $response;
	}
}

