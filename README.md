# lightning-strike-client-js

PHP client for the Lightning Strike REST API.

## Install

```bash
$ composer install blockstream/lightning-strike-client
```

## Use

```php
<?php
// initialize client
$strike = new LightingStrikeClient('http://localhost:8009');

// create invoice
$invoice = $strike->invoice(/*msatoshi*/ 50, /*metadata*/ [ 'customer' => 'Satoshi', 'products' => [ 'potato', 'chips' ]]);

echo "to pay, send $invoice->msatoshi milli-satoshis with rhash $invoice->rhash, or copy the BOLT11 payment request: $invoice->payreq"

// fetch invoice by id
$invoice = $strike->fetch('m51vlVWuIKGumTLbJ1RPb');
```

## Test

```bash
$ STRIKE_URL=http://localhost:8009 phpunit test
```

## License
MIT
