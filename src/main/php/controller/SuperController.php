<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class SuperController
{
	protected $app;
	
	protected function grabSubResource($resourcePath, $request)
	{
		$contentDepth = $request->headers->get("Content-Depth");
		
		//sublevel resource
		$subRequest = Request::create($resourcePath, 'GET', array(), $request->cookies->all(), array(), $request->server->all());
		$subRequest->headers->set("Content-Depth", $contentDepth-1);
		if ($request->getSession()) {
			 $subRequest->setSession($request->getSession());
		}
		$subResponse = $this->app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
		$subData = json_decode($subResponse->getContent(), true);
		return $subData;
	}
}
