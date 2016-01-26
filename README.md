# elasticpush-php
Biblioteca PHP para interagir com a API HTTP Elasticpush

[![Downloads](https://img.shields.io/packagist/dt/elasticpush/elasticpush-php.svg?style=flat-square)](https://packagist.org/packages/elasticpush/elasticpush-php)

# Instalação

composer require 'elasticpush/elasticpush-php':'dev-master'

# Exemplo de uso

in backend
```php

$token = 'token-xxxxxxxxxx';
$secretToken = 'secret-xxxxxxxxxx';
$appId = 2;
$elasticpush = (new Elasticpush(
                    sprintf('%s:%s', $token, $secretToken),
                    $appId
                ))->setClientId('123br');
$event = $elasticpush->dispatch(
    'channel-test',
    'event-test', [
        'message' => 'Test'
    ]
);

```

in browser
```javascript
var el = new Elasticpush('token-xxxxxxxxxx');
var app = el.subscribe('channel-test');
app.setClientId('123br');
app.on('event-test', function(data){
    alert(data.message);
});
```