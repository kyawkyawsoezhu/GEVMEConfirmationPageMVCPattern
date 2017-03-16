<?php
namespace App\Services;

use GuzzleHttp\Client;

class APIService
{
	private $client;
	private $base_url;
	private $client_id;
	private $client_secret;

	public function __construct()
	{
		$this->client = new Client();
		$this->base_url = config('api.base_url');
		$this->client_id = config('api.client_id');;
		$this->client_secret = config('api.client_secret');

	}

	function request($url, $method = false, array $data = [], $token = false)
	{
		$method = $method ? $method : 'GET';

		$options = [];
		if($data || $method == 'POST') $options['form_params'] = $data;
		if($data || $method == 'GET') $options['query'] = $data;
		if($token) $options['headers']['Authorization'] = 'Bearer ' . $token; 

		$response = $this->client->request($method, $url, $options);

		return json_decode($response->getBody(),true);
	}

	public function requestToken($grant_type)
	{
		$oauth_token_url = $this->base_url.'oauth/access_token';
		$data = [
	        'client_id' => $this->client_id,
	        'client_secret' => $this->client_secret,
	        'grant_type' => 'client_credentials'
		];
		$token = $this->request($oauth_token_url, 'POST', $data);
		return $token;
	}

 	private function cacheToken($grant_type, $access_token)
    {
        $expiresAt = Carbon::now()->addDay();
        cache(['oauth_token' => [
            'grant_type' => $grant_type,
            'access_token' => $access_token
        ]], $expiresAt);
    }	
}