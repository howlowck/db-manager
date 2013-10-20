<?php namespace Howlowck\DbManager\Facades;

use Illuminate\Support\Facades\Facade;

class DbManager extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'dbmanager'; }

}