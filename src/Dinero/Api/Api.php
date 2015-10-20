<?php namespace Dinero\Api;

use GuzzleHttp;
use Cache;

class Api
{
	protected $guzzle;

	protected $baseEndpoint = 'https://api.dinero.dk/v1';
	protected $authEndpoint = 'https://authz.dinero.dk/dineroapi/oauth/token';

	protected $apiKey;
	protected $storeId;
	protected $clientId;
	protected $authString;
	protected $clientSecret;
	protected $defaultPageSize = 100;
	protected $backupApiKeys = [ ];

	protected $authTokenString;

	function __construct()
	{
		$this->setApiKey(config('dinero.api_key'));
		$this->setStoreId(config('dinero.store_id', [ ]));
		$this->setClientId(config('dinero.client_id'));
		$this->setClientSecret(config('dinero.client_secret'));
		$this->setDefaultPageSize(config('dinero.default_page_size') > 1000 ? 1000 : config('dinero.default_page_size'));
		$this->setBackupApiKeys(config('dinero.backup_api_keys', [ ]));
		$this->setAuthString(base64_encode("{$this->clientId}:{$this->clientSecret}"));

		$this->enforceRequirements();

		$this->setGuzzle(new GuzzleHttp\Client([
			'headers' => [
				'Authorization' => "Basic {$this->getAuthString()}",
				'Content-Type'  => 'application/x-www-form-urlencoded',
			],
			'body'    => "grant_type=password&scope=read write&username={$this->getApiKey()}&password={$this->getApiKey()}"
		]));

		$this->auth();
	}

	private function enforceRequirements()
	{
		if ( $this->getClientId() == '' || $this->getClientId() == null )
		{
			throw new DataMissingException('Dinero "client_id" is not set.', 400);
		}

		if ( $this->getClientSecret() == '' || $this->getClientSecret() == null )
		{
			throw new DataMissingException('Dinero "client_secret" is not set.', 400);
		}

		if ( $this->getApiKey() == '' || $this->getApiKey() == null )
		{
			throw new DataMissingException('Dinero "api_key" is not set.', 400);
		}

		if ( $this->getStoreId() == '' || $this->getStoreId() == null )
		{
			throw new DataMissingException('Dinero "store_id" is not set.', 400);
		}
	}

	private function auth($force = false)
	{
		if ( $force == false )
		{
			if ( $this->hasAuthTokenInCache() )
			{
				$this->setAuthTokenString(Cache::get('authTokenString'), null, false);

				return true;
			}
		}

		try
		{
			$response = json_decode($this->getGuzzle()->post($this->authEndpoint)->getBody()->getContents());

			$this->setAuthTokenString("{$response->token_type} {$response->access_token}", $response->expires_in);

			return true;
		} catch( GuzzleHttp\Exception\ClientException $e )
		{
			if ( $e->hasResponse() )
			{
				$error = json_decode(json_decode($e->getResponse()->getBody()->getContents())->message)->error;
				throw new DineroAuthException($error);
			}

			return false;
		}
	}

	function getInvoice($id)
	{
		try {
			dd($this->getGuzzle()->get($this->getBaseEndpoint() . "/{$this->getStoreId()}/contacts")->getBody()->getContents());
		} catch( GuzzleHttp\Exception\ClientException $e )
		{
			dd($e->getResponse()->getBody()->getContents());
			$error = json_decode(json_decode($e->getResponse()->getBody()->getContents())->message)->error;
			throw new DineroAuthException($error);
		}

		return 'Invoice: ' . $id;
	}

	private function hasAuthTokenInCache()
	{
		return Cache::has('authTokenString');
	}

	/**
	 * @return mixed
	 */
	public function getAuthTokenString()
	{
		return $this->authTokenString;
	}

	/**
	 * @param mixed   $authTokenString
	 * @param int     $expire
	 * @param boolean $cache
	 */
	public function setAuthTokenString($authTokenString, $expire = 3600, $cache = true)
	{
		if ( $cache )
		{
			Cache::add('authTokenString', $authTokenString, ($expire / 60));
		}

		$this->authTokenString = $authTokenString;

		$this->setGuzzle(new GuzzleHttp\Client([ 'headers' => [ 'Authorization' => $this->getAuthTokenString() ] ]));
	}

	/**
	 * @return GuzzleHttp\Client
	 */
	public function getGuzzle()
	{
		return $this->guzzle;
	}

	/**
	 * @param GuzzleHttp\Client $guzzle
	 */
	public function setGuzzle(GuzzleHttp\Client $guzzle)
	{
		$this->guzzle = $guzzle;
	}

	/**
	 * @return string
	 */
	public function getBaseEndpoint()
	{
		return $this->baseEndpoint;
	}

	/**
	 * @return string
	 */
	public function getAuthEndpoint()
	{
		return $this->authEndpoint;
	}

	/**
	 * @return mixed
	 */
	public function getApiKey()
	{
		return $this->apiKey;
	}

	/**
	 * @param mixed $apiKey
	 */
	public function setApiKey($apiKey)
	{
		$this->apiKey = $apiKey;
	}

	/**
	 * @return mixed
	 */
	public function getStoreId()
	{
		return $this->storeId;
	}

	/**
	 * @param mixed $storeId
	 */
	public function setStoreId($storeId)
	{
		$this->storeId = $storeId;
	}

	/**
	 * @return mixed
	 */
	public function getClientId()
	{
		return $this->clientId;
	}

	/**
	 * @param mixed $clientId
	 */
	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}

	/**
	 * @return string
	 */
	public function getAuthString()
	{
		return $this->authString;
	}

	/**
	 * @param string $authString
	 */
	public function setAuthString($authString)
	{
		$this->authString = $authString;
	}

	/**
	 * @return mixed
	 */
	public function getClientSecret()
	{
		return $this->clientSecret;
	}

	/**
	 * @param mixed $clientSecret
	 */
	public function setClientSecret($clientSecret)
	{
		$this->clientSecret = $clientSecret;
	}

	/**
	 * @return int|mixed
	 */
	public function getDefaultPageSize()
	{
		return $this->defaultPageSize;
	}

	/**
	 * @param int|mixed $defaultPageSize
	 */
	public function setDefaultPageSize($defaultPageSize)
	{
		$this->defaultPageSize = $defaultPageSize;
	}

	/**
	 * @return array|mixed
	 */
	public function getBackupApiKeys()
	{
		return $this->backupApiKeys;
	}

	/**
	 * @param array|mixed $backupApiKeys
	 */
	public function setBackupApiKeys($backupApiKeys)
	{
		$this->backupApiKeys = $backupApiKeys;
	}

}
