<?php
require_once __DIR__.'/vendor/autoload.php';

if (!class_exists('LightningStrikeClient')):

class LightningStrikeClient {
  protected $api;

  public function __construct($url) {
    $this->api = new RestClient([ 'base_url' => rtrim($url, '/'), 'format' => 'json' ]);
  }

  /**
   * Create a new invoice.
   *
   * @param string|int $msatoshi
   * @param object $metadata
   * @return object the invoice
   */
  public function invoice($msatoshi, $metadata=null) {
    $res = $this->api->post('/invoice',
      json_encode([ 'msatoshi' => $msatoshi, 'metadata' => $metadata ]),
      [ 'Content-Type' => 'application/json' ]);

    if ($res->info->http_code !== 201) throw new Exception('saving invoice failed');

    return $res->decode_response();
  }

  /**
   * Fetch invoice by ID
   *
   * @param string $invoice_id
   * @return object the invoice
   */
  public function fetch($invoice_id) {
    $res = $this->api->get('/invoice/' . urlencode($invoice_id));
    if ($res->info->http_code !== 200) throw new Exception('fetching invoice failed');
    return $res->decode_response();
  }

  /**
   * Register a new webhook.
   *
   * @param string $invoice_id
   * @param string $url
   * @return bool
   */
  public function registerHook($invoice_id, $url) {
    $res = $this->api->post('/invoice/' . urlencode($invoice_id) . '/webhook', [ 'url' => $url ]);
    if ($res->info->http_code !== 201)
      throw new Exception('register hook failed');
    return true;
  }
}

endif;
