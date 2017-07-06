<?php
/**
 * @file PaymentResponse class - defines the structure and defaults for Pelecard payment response.
 */
namespace Pelecard;

class PaymentResponse implements \JsonSerializable {

  protected $PelecardStatusCode;
  protected $PelecardTransactionId;
  protected $ApprovalNo;
  protected $Token;
  protected $ParamX;
  protected $UserKey;
  protected $ConfirmationKey;
  protected $TotalX100;

  const USER_INPUT_ERROR_CODES = ['006', '033', '036'];

  /**
   * PaymentResponse constructor.
   *
   * @param $PelecardStatusCode
   * @param $PelecardTransactionId
   * @param $ApprovalNo
   * @param $Token
   * @param $ParamX
   * @param $UserKey
   * @param $ConfirmationKey
   * @param $UniqueKey
   * @param $TotalX100
   */
  public function __construct($PelecardStatusCode, $PelecardTransactionId, $ParamX, $UserKey, $ConfirmationKey, $TotalX100, $ApprovalNo = '', $Token = '') {
    $this->PelecardStatusCode = $PelecardStatusCode;
    $this->PelecardTransactionId = $PelecardTransactionId;
    $this->ApprovalNo = $ApprovalNo;
    $this->Token = $Token;
    $this->ParamX = $ParamX;
    $this->UserKey = $UserKey;
    $this->ConfirmationKey = $ConfirmationKey;
    $this->TotalX100 = $TotalX100;
  }

  /**
   * @return mixed
   */
  public function getPelecardStatusCode() {
    return $this->PelecardStatusCode;
  }

  /**
   * @return mixed
   */
  public function getPelecardTransactionId() {
    return $this->PelecardTransactionId;
  }

  /**
   * Get the validation request data in the right structure
   * @return array The validation request structured data
   */
  public function getValidationRequestStruct() {
    return [
      'ConfirmationKey' => $this->ConfirmationKey,
      'UniqueKey' => !empty($this->UserKey) ? $this->UserKey : $this->PelecardTransactionId, // Send the UserKey if given, otherwise the transaction ID
      'TotalX100' => $this->TotalX100
    ];
  }

  /**
   * Returns TRUE if the given error code is a user input error code.
   * 006 - Wrong CVV, 033 - Bad card, 036 - Expired card, 039 - Bad check digit
   *
   * @return bool
   */
  private function isUserInputError() {
    /* @todo consider adding 039 which stand for a bad check digit in the credit card number */
    return in_array($this->PelecardStatusCode, self::USER_INPUT_ERROR_CODES);
  }

  /**
   * Returns TRUE if the given error code is a user input error code.
   * 006 - Wrong CVV, 033 - Bad card, 036 - Expired card, 039 - Bad check digit
   *
   * @return bool
   */
  public static function isUserInputErrorByCode($errorCode) {
    /* @todo consider adding 039 which stand for a bad check digit in the credit card number */
    return in_array($errorCode, self::USER_INPUT_ERROR_CODES);
  }

  /**
   * Returns TRUE if retries are allowed
   *
   * @return bool
   */
  public function isRetriesAllowed() {
    return ($this->PelecardStatusCode != '000' && !$this->isUserInputError());
  }

  /**
   * Returns TRUE if the status code is success (000)
   *
   * @return bool
   */
  public function isStatusSuccess() {
    return ($this->PelecardStatusCode == '000');
  }

  /**
   * Return JSON serialized data
   * @return array
   */
  public function jsonSerialize() {
    return get_object_vars($this);
  }

}