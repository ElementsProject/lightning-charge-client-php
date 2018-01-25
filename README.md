# lightning-charge-client-php

PHP client for the Lightning Charge REST API.

## Install

```bash
$ composer require elementsproject/lightning-charge-client-php
```

## Use

```php
<?php
require_once 'vendor/autoload.php';

// Initialize client
$charge = new LightningChargeClient('http://localhost:8009', '[TOKEN]');

// Create invoice
$invoice = $charge->invoice([ 'msatoshi' => 50, 'metadata' => [ 'customer' => 'Satoshi', 'products' => [ 'potato', 'chips' ] ] ]);

tell_user("to pay, send $invoice->msatoshi milli-satoshis with rhash $invoice->rhash, or copy the BOLT11 payment request: $invoice->payreq");

// Create invoice denominated in USD
$invoice = $charge->invoice([ 'currency' => 'USD', 'amount' => 0.15 ]);

// Fetch invoice by id
$invoice = $charge->fetch('m51vlVWuIKGumTLbJ1RPb');

// Fetch all invoices
$invoice = $charge->fetchAll();

// Register web hook
$charge->registerHook('m51vlVWuIKGumTLbJ1RPb', 'http://my-server.com/my-callback-url');
```

*TODO*: document `wait`

## Test

```bash
$ CHARGE_URL=http://api-token:[TOKEN]@localhost:8009 phpunit test
```

## License
MIT
