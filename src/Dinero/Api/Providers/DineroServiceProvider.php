<?php namespace Dinero\Api\Providers;

use Illuminate\Support\ServiceProvider;

class DineroServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/config/dinero.php' => config_path('dinero.php'),
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
	}
}
