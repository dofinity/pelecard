<?php

namespace Pelecard;

/**
 * @file PelecardPayment class - allows to perform pelecard iframe payments.
 */

/**
 * Class Payment
 * @todo Add implements PayableInterface
 *
 * @package Pelecard\PelecardPayment
 */
class PelecardPayment {

  const PAYMENT_INIT_URI = 'PaymentGW/init';
  const PAYMENT_VALIDATE_URI = 'PaymentGW/ValidateByUniqueKey';
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
    return PelecardHttpRequest::pelecardPostRequest(self::PAYMENT_INIT_URI, $this->PaymentRequest);
  }

  /**
   * @return string
   */
  public function ValidatePayment() {
    return !empty(PelecardHttpRequest::pelecardPostRequest(self::PAYMENT_VALIDATE_URI, $this->PaymentResponse->getValidationRequestStruct())) ? TRUE : FALSE;
  }

}
