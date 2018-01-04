<?php

namespace Pelecard;

/**
 * @file CheckGoodParamX class - allows to check good paramX against Pelecard.
 */

/**
 * Class CheckGoodParamX
 */
class CheckGoodParamX implements \JsonSerializable {

  const CHECK_GOOD_PARAMX_URI = 'services/CheckGoodParamX';
  private $terminalNumber;
  private $user;
  private $password;
  private $paramX;
  private $shvaSuccessOnly;

  /**
   * CheckGoodParamX constructor.
   *
   * @param string $terminalNumber
   * @param string $user
   * @param string $password
   * @param string $paramX
   * @param string $shvaSuccessOnly
   */
  function __construct($terminalNumber, $user, $password, $paramX, $shvaSuccessOnly = 'true') {
    $this->terminalNumber = $terminalNumber;
    $this->user = $user;
    $this->password = $password;
    $this->paramX = $paramX;
    $this->shvaSuccessOnly = $shvaSuccessOnly;
  }

  /**
   * Submits a payment request and receives back an iframe URL, a confirmation key, and possible errors.
   *
   * @return: {"URL":"https://gateway20.pelecard.biz/PaymentGW?transactionId=5313aded-0b60-4bf3-9781-83d088b3c7c3","ConfirmationKey":"0c931d4cd8271f82f60a5c98be212f4a","Error":{"ErrCode":0}}
   */
  public function execute() {
    $response = PelecardHttpRequest::pelecardPostRequest(self::CHECK_GOOD_PARAMX_URI, $this);
    return json_decode($response);
  }

  /**
   * Return JSON serialized data
   * @return array
   */
  public function jsonSerialize() {
    return get_object_vars($this);
  }
}
