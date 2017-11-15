# lightning-strike-client-js

PHP client for the Lightning Strike REST API.

## Install

```bash
$ composer require elementsproject/lightning-strike-client-php
```

## Use

```php
<?php
$strike = new LightingStrikeClient('http://localhost:8009');

// Create invoice
$invoice = $strike->invoice(/*msatoshi*/ 50, /*metadata*/ [ 'customer' => 'Satoshi', 'products' => [ 'potato', 'chips' ]]);

tell_user("to pay, send $invoice->msatoshi milli-satoshis with rhash $invoice->rhash, or copy the BOLT11 payment request: $invoice->payreq");

// Fetch invoice by id
$invoice = $strike->fetch('m51vlVWuIKGumTLbJ1RPb');
```

TODO: document missing methods

## Test

```bash
$ STRIKE_URL=http://localhost:8009 phpunit test
```

## License
MIT
