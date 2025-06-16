<?php

namespace Finpay;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class HttpClient
{
  /**
   * @var ClientInterface
   */
  protected $client;

  /**
   * @var Configuration
   */
  protected $config;

  /**
   * @var int Host index
   */
  protected $hostIndex;

  public function __construct(
    ClientInterface $client,
    Configuration $config,
    $hostIndex = 0
  ) {
    $this->client = $client ?: new Client();
    $this->config = $config ?: Configuration::getDefaultConfiguration();
    $this->hostIndex = $hostIndex;
  }

  public static function process($method, $name, $url, $auth_key, $data_hash)
  {
    $client = new Client();
    $headers = [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'User-Agent' => 'finpay-php-v1.0.0',
      'Authorization' => $auth_key
    ];

    try {
      $options = HttpClient::createHttpClientOption();
      $options = array_merge($options, ['headers' => $headers, 'json' => $data_hash]);
      $response = $client->request($method, $url, $options);
    } catch (RequestException $e) {
      throw new FinpaySdkException(
        $e->getResponse() && $e->getResponse()->getBody() ? json_decode((string) $e->getResponse()->getBody()->getContents()) : null,
        (string) $e->getCode(),
        $e->getMessage() ? $e->getMessage() : sprintf('Error connecting to the API (%s)', $name)
      );
    } catch (ConnectException $e) {
      throw new FinpaySdkException(
        null,
        (string) $e->getCode(),
        $e->getMessage() ? $e->getMessage() : sprintf('Error connecting to the API (%s)', $name)
      );
    } catch (GuzzleException $e) {
      throw new FinpaySdkException(
        null,
        (string) $e->getCode(),
        $e->getMessage() ? $e->getMessage() : sprintf('Error instantiating client for API (%s)', $name)
      );
    }

    try {
      $body = $response->getBody()->getContents(); // Get the response body as string
      $response_array = json_decode($body); // Now decode the JSON string
    } catch (Exception $e) {
      throw new Exception("Http Client error unable to json_decode API response: " . $response . ' | Request url: ' . $url);
    }
    return $response_array;
  }

  protected static function createHttpClientOption()
  {
    $options = [];
    if (Configuration::$debug) {
      $options[RequestOptions::DEBUG] = fopen(Configuration::$debugFile, 'a');
      if (!$options[RequestOptions::DEBUG]) {
        throw new \RuntimeException('Failed to open the debug file: ' . Configuration::$debugFile);
      }
    }

    return $options;
  }
}
