<?php namespace Dinero\Api;

use GuzzleHttp;

class Api {

	private $guzzle;

	function __construct()
	{
		$this->guzzle = new GuzzleHttp\Client();
	}

	public static function getInvoice($id)
	{

	}

}
