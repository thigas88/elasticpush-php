<?php

use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\ClientException;

/**
 * Class Elasticpush
 */
class Elasticpush
{
    const API_VERSION = 'v1';

    const HOST = 'https://api.elasticpush.com/';

    /** @var Client */
    private $client;

    /**
     * @param $token
     * @param $app_id
     */
    public function __construct($token, $app_id)
    {
        $endpoint = self::HOST . self::API_VERSION . '/apps/' . $app_id . '/';
        $token = (strpos($token, ':')!==false) ? explode(':', $token) : trigger_error('Invalid token format');
        $this->client = new Client([
            'base_uri' => $endpoint,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-Token' => reset($token),
                'X-Secret-Token' => end($token),
            ],
            'connect_timeout' => 15,
            'timeout' => 10,
            'verify' => false
        ]);
    }

    /**
     * @param $client_id
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * @param $channel
     * @param $event
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function dispatch($channel, $event, array $data)
    {
        $request = [
            'channel' => $channel,
            'event' => $event,
            'data' => $data
        ];

        if (isset($this->client_id)) {
            $request['identifier'] = $this->client_id;
        }

        try {
            $response = $this->client->post('events', [
                'json' => $request
            ]);
            if (method_exists($response, 'getBody')
               && method_exists($response->getBody(), 'gxetContents')) {
                return json_decode($response->getBody()->getContents(), true);
            }
            return [
                'status' => true
            ];
        } catch (ClientException $ce) {
            $message = $this->prepareException($ce);
            throw new \RuntimeException($message);
        }
    }

    private function prepareException(ClientException $ce) {
        $message = 'An error occured';
        $body = json_decode($ce->getResponse()->getBody());

        if (!$body) {
            return $message;
        }

        return $body->message;
    }
}