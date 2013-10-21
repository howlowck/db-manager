<?php namespace Howlowck\DbManager;

use Illuminate\Support\ServiceProvider;
use Faker\Factory;

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
		$this->package('howlowck/db-manager');

		$this->app['dbmanager'] = $this->app->share(function ($app) {
			$schema = $app['db']->connection()->getSchemaBuilder();
			$db = $app['db'];

			return new DbManager($schema, $db);
		});

		$this->app['dbfaker'] = $this->app->share(function ($app) {
			$db = $app['dbmanager'];
			$faker = Factory::create();
			$fakerConfig = $app['config']->get('db-manager::faker');
			return new DbFaker($db, $faker, $fakerConfig);
		});

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('dbmanager', 'dbfaker');
	}

}