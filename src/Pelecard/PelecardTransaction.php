<?php

namespace Pelecard;

use GuzzleHttp\Client;

/**
 * Class PelecardTransaction
 * @todo Split to Factor class and service class
 *
 * @package Pelecard\PelecardTransaction
 */
class PelecardTransaction {
  const PAYMENT_VALIDATE_URI = 'PaymentGW/GetTransaction';

  private $terminal;
  private $user;
  private $password;
  private $TransactionId;

  private $DebitApproveNumber; // Reference
  private $DebitTotal; // Amount
  private $VoucherId; // VoucherNumber
  private $Token;
  private $TotalPayments; // NumberOfPayments
  private $CreditCardCompanyClearer; // ClearerID
  private $CreditCardNumber;
  private $CreditCardExpDate; // ExpDate
  private $CardHolderID; // OwnerIdNum
  private $FirstPaymentTotal;
  private $FixedPaymentTotal;

  /**
   * PelecardTransaction constructor.
   *
   * @param $terminal
   * @param $user
   * @param $password
   * @param $TransactionId
   */
  public function __construct($terminal, $user, $password, $TransactionId) {
    $this->terminal = $terminal;
    $this->user = $user;
    $this->password = $password;
    $this->TransactionId = $TransactionId;

    $transaction_response = PelecardHttpRequest::pelecardPostRequest(self::PAYMENT_VALIDATE_URI, $this->getTransactionRequestPayload());
    $transaction_result = json_decode($transaction_response);

    if (!empty($transaction_result->ResultData)) {
      $this->extractPropertiesFromResponse($transaction_result->ResultData);
    }
  }

  /**
   * Helper function to extract the class properties from the transaction response.
   * @param $response
   */
  private function extractPropertiesFromResponse($response) {
    $reflection = new \ReflectionClass($this);

    foreach ($reflection->getProperties() as $property) {
      $property_name = $property->getName();

      if (isset($response->{$property_name})) {
        $this->{$property_name} = $response->{$property_name};
      }
    }
  }

  /**
   * Helper function to get the transaction request's payload struct.
   * @return array
   */
  private function getTransactionRequestPayload() {
    return [
      'terminal' => $this->terminal,
      'user' => $this->user,
      'password' => $this->password,
      'TransactionId' => $this->TransactionId
    ];
  }

  /**
   * @return mixed
   */
  public function getTransactionTotal() {
    return $this->DebitTotal;
  }

  /**
   * @return mixed
   */
  public function getNumberOfPayments() {
    return $this->TotalPayments;
  }

  /**
   * @return mixed
   */
  public function getVoucherNumber() {
    return $this->VoucherId;
  }

  /**
   * @return mixed
   */
  public function getAuthorizationNumber() {
    return $this->DebitApproveNumber;
  }

  /**
   * @return int
   */
  public function getLastFourDigits() {
    // Extract the last 4 digits
    return substr($this->CreditCardNumber, -4);
  }

  /**
   * @return mixed
   */
  public function getCreditCardExpDate() {
    return $this->CreditCardExpDate;
  }

  /**
   * @return mixed
   */
  public function getCardHolderID() {
    return $this->CardHolderID;
  }

  /**
   * @return mixed
   */
  public function getToken() {
    return $this->Token;
  }

  /**
   * @return mixed
   */
  public function getFirstPaymentTotal() {
    return $this->FirstPaymentTotal;
  }

  /**
   * @return mixed
   */
  public function getFixedPaymentTotal() {
    return $this->FixedPaymentTotal;
  }

  /**
   * @return mixed
   */
  public function getClearer() {
    return $this->CreditCardCompanyClearer;
  }

  /**
   * Returns the clearer name
   * @return string
   */
  public function getClearerName() {
    return $this->getClearerNamebyNum($this->CreditCardCompanyClearer);
  }

  /**
   * @param int $num
   *   Clearer number.
   *
   * @return string The clearer name
   */
  private function getClearerNamebyNum($num) {
    $map = [
      1 => t('Isracard'),
      2 => t('Visa Cal'),
      3 => t('Diners'),
      4 => t('American Express'),
      5 => t('Leumi card'),
    ];

    return $map[$num];
  }

}
