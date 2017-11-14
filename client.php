<?php
require_once __DIR__.'/vendor/autoload.php';

class LightningStrikeClient {
  protected $api;

  public function __construct($url) {
    $this->api = new RestClient([ 'base_url' => $url, 'format' => 'json' ]);
  }

  public function invoice($msatoshi, $metadata=null) {
    $res = $this->api->post('/invoice',
      json_encode([ 'msatoshi' => $msatoshi, 'metadata' => $metadata ]),
      [ 'Content-Type' => 'application/json' ]);

    if ($res->info->http_code !== 201)
      throw new Exception('cannot create invoice');

    return $res->decode_response();
  }

  public function fetch($invoice_id) {
    $res = $this->api->get('/invoice/' . urlencode($invoice_id));
    if ($res->info->http_code !== 200)
      throw new Exception('unable to fetch invoice');
    return $res->decode_response();
  }

  public function registerHook($invoice_id, $url) {
    $res = $this->api->post('/invoice/' . urlencode($invoice_id) . '/webhook', [ 'url' => $url ]);
    if ($res->info->http_code !== 201)
      throw new Exception('unable to register hook');
    return true;
  }
}
