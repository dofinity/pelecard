<?php

namespace Pelecard;

/**
 * @file PelecardHttpRequest class - wraps HTTP requests to Pelecard.
 */

use GuzzleHttp\Client;

/**
 * Class PelecardHttpRequest
 *
 * @package Pelecard\PelecardHttpRequest
 */
class PelecardHttpRequest {

  const GATEWAY_BASE_URI = 'https://gateway20.pelecard.biz';
  const CONNECTION_TIMEOUT = 5;
  const REQUEST_TIMEOUT = 10;

  /**
   * @var array|null $clientConfig Client configuration settings.
   * @see \GuzzleHttp\RequestOptions for a list of available request options.
   */
  public static $clientConfig;

  /**
   * Helper function to wrap our POST requests
   * @param string $uri The relative URI
   * @param mixed $data The post data
   *
   * @return string The response content
   */
  public static function pelecardPostRequest($uri, $data) {
    // Make the Post call
    $client = new Client(self::getConfig());

    $response = $client->post($uri, ['json' => $data]);

    //Extract the contents from the response.
    return $response->getBody()->getContents();
  }

  /**
   * Returns default GuzzleHttp\Client config merged with user defined.
   *
   * @see \GuzzleHttp\RequestOptions for a list of available request options.
   *
   * @return array
   */
  public static function getConfig() {
    return array_merge(
      [
        'connect_timeout' => self::CONNECTION_TIMEOUT, // default connection timeout
        'timeout' => self::REQUEST_TIMEOUT, // default request timeout
      ],
      (is_array(self::$clientConfig)) ? self::$clientConfig : [], // user config
      [
        'base_uri' => self::GATEWAY_BASE_URI, // overwrite base uri
        'headers' => ['Content-Type' => 'application/json'], // overwrite headers
      ]
    );
  }

}