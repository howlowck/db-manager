<?php namespace Howlowck\DbManager;

use Illuminate\Support\ServiceProvider;

class DbManagerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['dbmanager'] = $this->app->share(function ($app) {
			$schema = $app['db']->connection()->getSchemaBuilder();
			$db = $app['db'];
			return new DbManager($schema, $db);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('dbmanager');
	}

}