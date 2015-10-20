<?php namespace Dinero\Api\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Dinero extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'Dinero\Api\Api'; }

}