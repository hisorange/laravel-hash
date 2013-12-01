<?php 
namespace hisorange\hash\Providers;

use hisorange\hash\Hasher;
use Illuminate\Hashing\HashServiceProvider as ServiceProvider;

class HashServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register the package's resources.
		$this->package('hisorange/laravel-hash');

		// Register the package's config.
		$this->app['config']->package('hisorange/laravel-hash', dirname(dirname(dirname(__DIR__))).'/config');

		// Share the 'hash' container.
		$this->app['hash'] = $this->app->share(function($app) { 
			return new Hasher($app['config']); 
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('hash');
	}

}