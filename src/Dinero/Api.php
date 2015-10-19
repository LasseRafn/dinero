<?php namespace Dinero;

use GuzzleHttp;

class Api {

	private $guzzle;

	function __construct()
	{
		$this->guzzle = new GuzzleHttp\Client();
	}

	public function doShit()
	{

	}

}
