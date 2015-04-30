<?php

use \GuzzleHttp\Client;

class Elasticpush
{
	const API_VERSION = 'v1';

	private $settings = [
				'host' => 'http://api.elasticpush.com/',
				'api_version' => self::API_VERSION
			];

	private $client;
	public function __construct($token, $app_id)
	{
		$endpoint = $this->settings['host'] . $this->settings['api_version'] . '/apps/' . $app_id . '/';
		$token = (strpos($token, ':')!==false) ? explode(':', $token) : trigger_error('Invalid token format');
		$this->client = new Client([
				'base_url' => $endpoint,
				'defaults' => [
					'headers' => [
						'Content-Type' => 'application/json',
						'Accept' => 'application/json',
						'X-Token' => $token[0],
						'X-Secret-Token' => $token[1],
					],					
					'connect_timeout' => 15,
					'timeout' => 10,
					'verify' => false
				]
			]);
	}
	public function setClientId($client_id)
	{
		$this->client_id = $client_id;
		return $this;
	}
	public function dispatch($channel, $event, array $data)
	{
		$request = [
			'channel' => $channel,
			'event' => $event,
			'data' => $data
		];
		if(isset($this->client_id)) 
			$request['client_id'] = $this->client_id;

		$this->client->post('events', ['json' => $request, 'future' => true]);
	}
}