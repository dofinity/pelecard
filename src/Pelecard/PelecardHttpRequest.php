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
   * Helper function to wrap our POST requests
   * @param string $uri The relative URI
   * @param mixed $data The post data
   *
   * @return string The response content
   */
  public static function pelecardPostRequest($uri, $data) {
    // Make the Post call
    $client = new Client(['base_uri' => self::GATEWAY_BASE_URI]);

    $response = $client->post($uri,
      [
        'headers' => ['Content-Type' => 'application/json'],
        'json' => $data,
        'connect_timeout' => self::CONNECTION_TIMEOUT,
        'timeout' => self::REQUEST_TIMEOUT
      ]
    );

    //Extract the contents from the response.
    return $response->getBody()->getContents();
  }

}