# lightning-strike-client-php

PHP client for the Lightning Strike REST API.

## Install

```bash
$ composer require elementsproject/lightning-strike-client-php
```

## Use

```php
<?php
// Initialize client
$strike = new LightingStrikeClient('http://localhost:8009', '[TOKEN]');
// alternatively, the token can be provided as part of URL:
$strike = new LightingStrikeClient('http://api-token:[TOKEN]@localhost:8009');

// Create invoice
$invoice = $strike->invoice([ 'msatoshi' => 50, 'metadata' => [ 'customer' => 'Satoshi', 'products' => [ 'potato', 'chips' ] ] ]);

tell_user("to pay, send $invoice->msatoshi milli-satoshis with rhash $invoice->rhash, or copy the BOLT11 payment request: $invoice->payreq");

// Fetch invoice by id
$invoice = $strike->fetch('m51vlVWuIKGumTLbJ1RPb');

// Create invoice denominated in USD
$invoice = $strike->invoice([ 'currency' => 'USD', 'amount' => 0.15 ]);
```

TODO: document missing methods

## Test

```bash
$ STRIKE_URL=http://api-token:[TOKEN]@localhost:8009 phpunit test
```

## License
MIT
