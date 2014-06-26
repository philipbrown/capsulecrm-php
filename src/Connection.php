<?php namespace PhilipBrown\CapsuleCRM;

use GuzzleHttp\Client;

class Connection {

  /**
   * The API Key
   *
   * @var string
   */
  protected $key;

  /**
   * The subdomain
   *
   * @var string
   */
  protected $subdomain;

  /**
   * The HTTP Client
   *
   * @var GuzzleHttp\Client
   */
  protected $client;

  /**
   * Create a new Connection instance
   *
   * @param string $key
   * @param string $subdomain
   * @return void
   */
  public function __construct($key, $subdomain)
  {
    $this->key = $key;
    $this->subdomain = $subdomain;
  }

  /**
   * Send a GET request
   *
   * @param string $url
   * @param array $params
   * @return Guzzle\Http\Message\Response
   */
  public function get($url, array $params = [])
  {
    $request = $this->client()->createRequest('GET', $url);

    $query = $request->getQuery();

    foreach($params as $k => $v)
    {
      $query->set($k, $v);
    }

    return $this->client()->send($request);
  }

  /**
   * Send a POST request
   *
   * @param string $url
   * @param string $body
   * @return Guzzle\Http\Message\Response
   */
  public function post($url, $body)
  {
    $response = $this->client()->post($url, ['body' => $body]);

    return $this->processPostResponse($response);
  }

  /**
   * Send a PUT request
   *
   * @return Guzzle\Http\Message\Response
   */
  public function put($url, $body)
  {
    return $this->client()->put($url, ['body' => $body]);
  }

  /**
   * Send a DELETE request
   *
   * @return Guzzle\Http\Message\Response
   */
  public function delete($url)
  {
    return $this->client()->delete($url);
  }

  /**
   * Return an HTTP client instance
   *
   * @return GuzzleHttp\Client
   */
  public function client()
  {
    if($this->client) return $this->client;

    return new Client([
      'base_url' => "https://$this->subdomain.capsulecrm.com",
      'defaults' => [
        'auth' => [$this->key, 'x', 'basic'],
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json'
        ]
      ]
    ]);
  }

}
