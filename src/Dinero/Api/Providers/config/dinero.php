<?php
return [

	/*
	|--------------------------------------------------------------------------
	| Client ID
	|--------------------------------------------------------------------------
	|
	| Input your client id here. You should get this after
	| applying as a developer, together with your client
	| secret.
	|
	*/

	'clientId'        => env('DINERO_CLIENT_ID', ''),

	/*
	|--------------------------------------------------------------------------
	| Client Secret
	|--------------------------------------------------------------------------
	|
	| Input your client secret here. You should get this after
	| applying as a developer, together with your client
	| id.
	|
	*/

	'clientId'        => env('DINERO_CLIENT_SECRET', ''),

	/*
	|--------------------------------------------------------------------------
	| Client
	|--------------------------------------------------------------------------
	|
	| Here goes the Api key from Dinero. This variable
	| should (usually) be 32-characters long, like the
	| example below. You get your key from Dinero:
	|
	| https://app.dinero.dk/apikeys
	|
	*/

	'apiKey'        => env('DINERO_API_KEY', 'abcdefghijklmnopqrstuvwxyz123456'),

	/*
	|--------------------------------------------------------------------------
	| Backup Api keys
	|--------------------------------------------------------------------------
	|
	| As Dinero has specified that you can use multiple
	| keys to prevent rate limiting*, an option to add
	| multiple keys in an array is hereby granted.
	| If you hit the rate limit, the wrapper will switch
	| to another key from this list, and so on.
	|
	| However, you should contact their API guy to verify
	| that this is allowed.
	|
	| * https://api.dinero.dk/docs#throttling
	|
	*/

	'backupApiKeys' => [ ],

	/*
	|--------------------------------------------------------------------------
	| Store ID
	|--------------------------------------------------------------------------
	|
	| This is an optional variable, but it allows you to
	| use the Dinero::getStoreId() method.
	|
	| You can always use the Dinero::setStoreId(...) method
	| to set it. However the store/company id is not ever
	| used in api calls.
	|
	*/

	'storeId'       => env('DINERO_STORE_ID', null),

	/*
	|--------------------------------------------------------------------------
	| Default page size (pagination)
	|--------------------------------------------------------------------------
	|
	| Dinero uses a default of 100, you might want to
	| use another default.
	|
	| The max is 1000.
	|
	*/

	'defaultPageSize' => 100

];