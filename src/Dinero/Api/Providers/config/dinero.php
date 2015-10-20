<?php
return [

	/*
	|--------------------------------------------------------------------------
	| Client ID
	|--------------------------------------------------------------------------
	|
	| Input your client id here. You should get this after
	| applying as a developer, together with your client
	| secret. This would *probably* be your company name.
	|
	*/

	'client_id'        => env('DINERO_CLIENT_ID', ''),

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

	'client_secret'        => env('DINERO_CLIENT_SECRET', ''),

	/*
	|--------------------------------------------------------------------------
	| Api Key
	|--------------------------------------------------------------------------
	|
	| Here goes the Api key from Dinero. This variable
	| should (usually) be 32-characters long, like the
	| example below. You get your key from Dinero:
	|
	| https://app.dinero.dk/apikeys
	|
	*/

	'api_key'        => env('DINERO_API_KEY', 'abcdefghijklmnopqrstuvwxyz123456'),

	/*
	|--------------------------------------------------------------------------
	| Store ID (Also known as Organization Id)
	|--------------------------------------------------------------------------
	|
	| This is required in order to manage your organization
	| in Dinero. Most (if not all) calls require this.
	|
	| Can be found in the bottom of the page in your
	| dashboard on Dinero.
	|
	*/

	'store_id'       => env('DINERO_STORE_ID', null),

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

	'backup_api_keys' => [ ],

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

	'default_page_size' => 100

];