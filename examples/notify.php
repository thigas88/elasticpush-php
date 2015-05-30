<?php

require '../vendor/autoload.php';

$key = '9751998fa08dea907624a815270d294118e9fc5c85be1453bd4f338acf467e01';
$secret = 'd7cb880a62ec0a6910cb449d5c6ca60cad8e233f171ed53f2b91ff88bf99cff3';
$elasticpush = new Elasticpush( $key . ':' . $secret, 11);

$elasticpush->setClientId(0);

$event = $elasticpush->dispatch('elasticpush-test', 'event-test', [
        'message' => 'Hello world!'
]);
