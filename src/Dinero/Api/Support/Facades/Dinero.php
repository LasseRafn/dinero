<?php namespace Dinero\Api\Support\Facades;


class Dinero extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'dinero'; }

	public static function getInvoice($id)
	{
		return $id;
	}

}