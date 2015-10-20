## Api Wrapper for Dinero

## Instructions

#### Require the package
```
composer require lasserafn/dinero
```
#### After composer has updated, add the service provider to your `config/app.php` file, in the `$providers` variable
```
$providers = [
	Dinero\Api\Providers\DineroServiceProvider::class
];
```
#### Now, in the same file, under your `$aliases` variable.
```
$aliases = [
	'Dinero' => Dinero\Api\Support\Facades\Dinero::class
];
```
#### Generate a config file for the api. Head into your terminal/console and type:
```
php artisan vendor:publish
```
#### Edit your `config/dinero.php` file to suit your needs. All options are documented.
#### Start using the wrapper in your classes. Example:
```
<?php namespace App\Http\Controllers;

use Dinero;

class DineroController extends Controller
{
	function getInvoice($id)
	{
		return view('dashboard.pages.invoice', [
			'invoice' => Dinero::getInvoice($id)
		]);
	}
}
```
