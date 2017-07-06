<?php

namespace Pelecard;

/**
 * @file PelecardPayment class - allows to perform pelecard iframe payments.
 */

use GuzzleHttp\Client;

/**
 * Class Payment
 * @todo Add implements PayableInterface
 *
 * @package Pelecard\PelecardPayment
 */
class PelecardPayment {

  const GATEWAY_BASE_URI = 'https://gateway20.pelecard.biz';
  const PAYMENT_INIT_URI = 'PaymentGW/init';
  const PAYMENT_VALIDATE_URI = 'PaymentGW/ValidateByUniqueKey';
  const CONNECTION_TIMEOUT = 5;
  const REQUEST_TIMEOUT = 10;
  private $PaymentRequest;
  private $PaymentResponse;

  /**
   * @param \Pelecard\PaymentRequest $PaymentRequest
   */
  public function setPaymentRequest($PaymentRequest) {
    $this->PaymentRequest = $PaymentRequest;
  }

  /**
   * @param \Pelecard\PaymentRespnse $PaymentRequest
   */
  public function setPaymentResponse($PaymentResponse) {
    $this->PaymentResponse = $PaymentResponse;
  }

  /**
   * Submits a payment request and receives back an iframe URL, a confirmation key, and possible errors.
   *
   * @return: {"URL":"https://gateway20.pelecard.biz/PaymentGW?transactionId=5313aded-0b60-4bf3-9781-83d088b3c7c3","ConfirmationKey":"0c931d4cd8271f82f60a5c98be212f4a","Error":{"ErrCode":0}}
   */
  public function SubmitPaymentRequest() {
    return $this->pelecardPostRequest(self::PAYMENT_INIT_URI, $this->PaymentRequest);
  }

  /**
   * @return string
   */
  public function ValidatePayment() {
    return !empty($this->pelecardPostRequest(self::PAYMENT_VALIDATE_URI, $this->PaymentResponse->getValidationRequestStruct())) ? TRUE : FALSE;
  }

  public function GetShvaCodeMessage($TransactionCode) {

  }

  /**
   * Helper function to wrap our POST requests
   * @param string $uri The relative URI
   * @param mixed $data The post data
   *
   * @return string The response content
   */
  private function pelecardPostRequest($uri, $data) {
    // Make the Post call
    $client = new Client(['base_uri' => self::GATEWAY_BASE_URI]);

    $response = $client->post($uri,
      [
        'headers' => ['Content-Type'=>'application/json'],
        'json' => $data,
        'connect_timeout' => self::CONNECTION_TIMEOUT,
        'timeout' => self::REQUEST_TIMEOUT
      ]
    );

    //Extract the contents from the response.
    return $response->getBody()->getContents();
  }

}