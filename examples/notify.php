<?php

require '../vendor/autoload.php';


$key = '2e4c651f7199dd10c8ed6ef56ef3337e1898b521994fafb9e2b5ec9a99a04bac';
$secret = '169843c1d4b791ed5bb2ed2e1f90991a3f6b8dc2b40f094d84e1f4cbc70dfd5d';
$elasticpush = new Elasticpush( $key . ':' . $secret, 2);

$elasticpush->setClientId(0);

$event = $elasticpush->dispatch('elasticpush-test', 'event-test', [
      	'message' => 'Teste',
	'title' => 'Testando'
]);

