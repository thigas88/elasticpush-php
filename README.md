# elasticpush-php
Biblioteca PHP para interagir com a API HTTP Elasticpush

[![Downloads](https://img.shields.io/packagist/dt/elasticpush/elasticpush-php.svg?style=flat-square)](https://packagist.org/packages/elasticpush/elasticpush-php)

# Instalação

composer require 'elasticpush/elasticpush-php':'dev-master'

# Exemplo de uso

```

$token = '2e4c651f7199dd10c8ed6';
$secretToken = '169843c1d4b791ed5bb2e';
$appId = 2;
$elasticpush = (new Elasticpush(
                    sprintf('%s:%s', $token, $secretToken),
                    $appId
                ))->setClientId(0);
$event = $elasticpush->dispatch(
    'elasticpush-test',
    'event-test', [
        'message' => 'Teste',
        'title' => 'Testando'
    ]
);

```