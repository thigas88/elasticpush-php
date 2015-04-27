<?php

require '../vendor/autoload.php';

$access_token = '182cebb17d71d3b2b2cd79b03dc2e74a82d687e4';
// $secret = '182cebb17d71d3b2b2cd79b03dc2e74a82d687e4';
// $access_token = $token . ':' . $secret;

$elasticpush = new Elasticpush($access_token, 1100);

$event = $elasticpush->dispatch('elasticpush-home', 'notifications', [
		'message' => 'testando :)'
]);
