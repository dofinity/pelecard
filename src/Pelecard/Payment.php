<?php

namespace Pelecard\Payment;

use Pelecard\PaymentRequest\PaymentRequest;
use GuzzleHttp\Client;

/**
 * Class Payment - allows to perform pelecard iframe payments.
 * @package Pelecard\Payment
 */
class Payment {

  const GATEWAY_BASE_URI = 'https://gateway20.pelecard.biz/PaymentGW/';
  const PAYMENT_INIT_URI = 'init';
  const PAYMENT_VALIDATE_URI = 'ValidateByUniqueKey';
  const CONNECTION_TIMEOUT = 5;
  const REQUEST_TIMEOUT = 10;
  private $PaymentRequest;

  /**
   * Payment constructor.
   * @param $terminal
   * @param $user
   * @param $password
   * @param $GoodURL
   * @param $Total
   * @param null $ErrorURL
   * @internal param $PaymentRequest
   */
  public function __construct($terminal, $user, $password, $GoodURL, $Total, $ErrorURL = NULL) {
    $this->PaymentRequest = new PaymentRequest($terminal, $user, $password, $GoodURL, $Total, $ErrorURL);
  }

  /**
   * Submits a payment request and receives back an iframe URL, a confirmation key, and possible errors.
   *
   * @return: {"URL":"https://gateway20.pelecard.biz/PaymentGW?transactionId=5313aded-0b60-4bf3-9781-83d088b3c7c3","ConfirmationKey":"0c931d4cd8271f82f60a5c98be212f4a","Error":{"ErrCode":0}}
   */
  public function SubmitPaymentRequest() {

    //ERP Post call
    $client = new Client(['base_uri' => self::GATEWAY_BASE_URI]);

    $response = $client->post(self::PAYMENT_INIT_URI,
      [
        'json' => json_encode($this->PaymentRequest),
        'connect_timeout' => self::CONNECTION_TIMEOUT,
        'timeout' => self::REQUEST_TIMEOUT
      ]
    );

    //Extract the contents from the response.
    return $response->getBody()->getContents();
  }

  /**
   *
   */
  public function ValidatePayment() {

  }

  /**
   * @param $TransactionCode
   */
  public function GetShvaCodeMessage($TransactionCode) {

  }

}
