<?php

require '../vendor/autoload.php';


$key = 'ba9f59c1d0af5f8cc3c3983717c329712b1367eea94802aaf03cea56c9659a6d';
$secret = '72199a0a69920e01964166a7a42e4934b7c42d6269d40115ffdcd31678be1b6f';
$elasticpush = new Elasticpush( $key . ':' . $secret, 8);

$elasticpush->setClientId(0);

$event = $elasticpush->dispatch('elasticpush-test', 'event-test', [
      	'message' => 'Teste',
	'title' => 'Testando'
]);

