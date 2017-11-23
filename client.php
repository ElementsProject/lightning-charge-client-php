<?php
if (!class_exists('LightningStrikeClient')):

class LightningStrikeClient {
  protected $api;

  public function __construct($url) {
    $this->api = new RestClient([ 'base_url' => rtrim($url, '/') ]);
  }

  /**
   * Create a new invoice.
   *
   * @param string|int $msatoshi
   * @param object $metadata
   * @return object the invoice
   */
  public function invoice($props) {
    $res = $this->api->post('/invoice', json_encode($props), [ 'Content-Type' => 'application/json' ]);

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
   * Wait for an invoice to be paid.
   *
   * @param string $invoice_id
   * @param int $timeout the timeout in seconds
   * @return object|bool the paid invoice if paid, false otherwise.
   */
  public function wait($invoice_id, $timeout) {
    $res = $this->api->get('/invoice/' . urlencode($invoice_id) . '/wait?timeout=' . (int)$timeout);

    if ($res->info->http_code === 402)
      return false;
    else if ($res->info->http_code === 200)
      return $res->decode_response();
    else
      throw new Exception('invalid response');
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
