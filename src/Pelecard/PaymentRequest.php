<?php
/**
 * @file PaymentRequest class - defines the structure and defaults for pelecard payment request.
 */
namespace Pelecard;

class PaymentRequest implements \JsonSerializable {

  // Authentication info
  protected $terminal;
  protected $user;
  protected $password;

  // Redirect URLs
  protected $GoodURL;
  protected $ErrorURL;
  protected $CancelURL;

  // Currency
  protected $ActionType;
  protected $Currency;

  // Total
  protected $Total;
  protected $FreeTotal;

  // Result and Feedback
  protected $resultDataKeyName;
  protected $ServerSideGoodFeedbackURL;
  protected $ServerSideErrorFeedbackURL;

  // Notification emails
  protected $NotificationGoodMail;
  protected $NotificationErrorMail;
  protected $NotificationFailMail;

  // Tokens
  protected $CreateToken;
  protected $TokenForTerminal;
  protected $TokenCreditCardDigits;

  // Form options
  protected $Language;
  protected $CardHolderName;
  protected $CustomerIdField;
  protected $Cvv2Field;
  protected $EmailField;
  protected $TelField;
  protected $SplitCCNumber;

  protected $IsToken;
  protected $FeedbackOnTop;
  protected $FeedbackDataTransferMethod;
  protected $UseBuildInFeedbackPage;

  // Payment installments
  protected $MaxPayments;
  protected $MinPayments;
  protected $MinPaymentsForCredit;
  protected $DisabledPaymentNumbers; // comma separated string of values
  protected $FirstPayment; // the amount is in agorot/cents

  // Order identification
  protected $AuthNum;
  protected $ShopNo;
  protected $ParamX;
  protected $ShowXParam;
  protected $AddHolderNameToXParam;
  protected $UserKey;

  // Display options
  protected $SetFocus;
  protected $CssURL;
  protected $TopText;
  protected $BottomText;
  protected $LogoURL;
  protected $ShowConfirmationCheckbox;
  protected $TextOnConfirmationBox;
  protected $ConfirmationLink;
  protected $HiddenPelecardLogo;
  protected $AllowedBINs;
  protected $BlockedBINs;
  protected $ShowSubmitButton;
  protected $AccessibilityMode;
  protected $TakeIshurPopUp;
  protected $SupportedCards; // Supported credit cards

  // Custom field captions
  protected $CaptionSet;

  // UserData. Free text fields. These fields are not sent to SHVA. These fields return with transaction details
  protected $UserData;

  // Allows us to simulate good/error response for transaction
  protected $QAResultStatus;

  /**
   * Payment constructor.
   *
   * Constructs a default payment initialization based on Pelecard's sandbox "payment" defaults.
   *
   * @param $terminal
   * @param $user
   * @param $password
   * @param $GoodURL
   * @param $ErrorURL
   * @param $ActionType // default: J4
   * @param $Currency // default: 1 = ILS
   * @param $Total
   * @param $FreeTotal
   * @param $CreateToken
   * @param $Language
   * @param $CardHolderName
   * @param $CustomerIdField
   * @param $Cvv2Field
   * @param $EmailField
   * @param $TelField
   * @param $SplitCCNumber
   * @param $UseBuildInFeedbackPage
   * @param $MaxPayments
   * @param $MinPayments
   * @param $MinPaymentsForCredit
   * @param $FirstPayment
   * @param $ShopNo
   * @param $ParamX
   * @param $ShowXParam
   * @param $AddHolderNameToXParam
   * @param $CssURL
   * @param $LogoURL
   * @param $ShowConfirmationCheckbox
   * @param $HiddenPelecardLogo
   * @param $AccessibilityMode
   * @param $TakeIshurPopUp
   */
  public function __construct($terminal, $user, $password, $GoodURL, $Total, $ErrorURL = NULL, $ActionType = 'J4', $Currency = 1, $FreeTotal = 'False',
                              $CreateToken = 'False', $Language = 'HE', $CardHolderName = 'hide', $CustomerIdField = 'optional', $Cvv2Field = 'optional',
                              $EmailField = 'hide', $TelField = 'hide', $SplitCCNumber = 'False', $FeedbackOnTop = 'False', $UseBuildInFeedbackPage = 'False',
                              $MaxPayments = 12, $MinPayments = 1, $MinPaymentsForCredit = 7, $FirstPayment = 'auto', $ShopNo = '001', $ParamX = '',
                              $ShowXParam = 'False', $AddHolderNameToXParam = 'False', $CssURL = 'https://gateway20.pelecard.biz/Content/Css/variant-he-1.css',
                              $LogoURL = 'https://gateway20.pelecard.biz/Content/images/Pelecard.png', $ShowConfirmationCheckbox = 'False', $HiddenPelecardLogo = 'False',
                              $AccessibilityMode = 'True', $TakeIshurPopUp = 'False') {
    $this->terminal = $terminal;
    $this->user = $user;
    $this->password = $password;
    $this->GoodURL = $GoodURL;
    $this->ErrorURL = $ErrorURL;
    $this->ActionType = $ActionType;
    $this->Currency = $Currency;
    $this->Total = $Total;
    $this->FreeTotal = $FreeTotal;
    $this->CreateToken = $CreateToken;
    $this->Language = $Language;
    $this->CardHolderName = $CardHolderName;
    $this->CustomerIdField = $CustomerIdField;
    $this->Cvv2Field = $Cvv2Field;
    $this->EmailField = $EmailField;
    $this->TelField = $TelField;
    $this->SplitCCNumber = $SplitCCNumber;
    $this->FeedbackOnTop = $FeedbackOnTop;
    $this->UseBuildInFeedbackPage = $UseBuildInFeedbackPage;
    $this->MaxPayments = $MaxPayments;
    $this->MinPayments = $MinPayments;
    $this->MinPaymentsForCredit = $MinPaymentsForCredit;
    $this->FirstPayment = $FirstPayment;
    $this->ShopNo = $ShopNo;
    $this->ParamX = $ParamX;
    $this->ShowXParam = $ShowXParam;
    $this->AddHolderNameToXParam = $AddHolderNameToXParam;
    $this->CssURL = $CssURL;
    $this->LogoURL = $LogoURL;
    $this->ShowConfirmationCheckbox = $ShowConfirmationCheckbox;
    $this->HiddenPelecardLogo = $HiddenPelecardLogo;
    $this->AccessibilityMode = $AccessibilityMode;
    $this->TakeIshurPopUp = $TakeIshurPopUp;
  }

  /**
   * @param string $ServerSideGoodFeedbackURL
   *
   * @return \Pelecard\PaymentRequest $ServerSideGoodFeedbackURL
   */
  public function setServerSideGoodFeedbackURL($ServerSideGoodFeedbackURL) {
    $this->ServerSideGoodFeedbackURL = $ServerSideGoodFeedbackURL;
    return $this;
  }

  /**
   * @param string $ServerSideErrorFeedbackURL
   *
   * @return \Pelecard\PaymentRequest $ServerSideErrorFeedbackURL
   */
  public function setServerSideErrorFeedbackURL($ServerSideErrorFeedbackURL) {
    $this->ServerSideErrorFeedbackURL = $ServerSideErrorFeedbackURL;
    return $this;
  }

  /**
   * This method should be used in order to enable test mode.
   * When enabled - all transactions to Pelecard will pass.
   * Note: Should never be enabled on production!!
   *
   * @param $enable
   * @todo Note that AuthNum don't have setter at the moment, therefore we are not thinking about the "real" AuthNum
   */
  public function enableTestMode($enable) {
    $this->AuthNum = $enable ? '1234567' : NULL;
  }

  /**
   * Sets UserData which described as "Free text fields" in manual.
   * These fields are not sent to SHVA.
   * These fields return with transaction details.
   *
   * @param string $fieldName User field name. Possible values are UserData1, UserData2, ...UserData15
   * @param string $data      Data itself
   * @throws \InvalidArgumentException
   */
  public function setUserData($fieldName, $data) {
    if (!is_string($fieldName) || preg_match("/^UserData([1-9]|1[0-5])$/", $fieldName) !== 1) {
      throw new \InvalidArgumentException('Invalid `$fieldName`. Keys UserData1, UserData2, ...UserData15 are allowed');
    }
    if (!is_string($data) && $data !== null) {
      throw new \InvalidArgumentException('Invalid `$data`. Data must be string or `null` when you need to unset it');
    }
    if (!is_array($this->UserData)) $this->UserData = [];
    $this->UserData[$fieldName] = $data;
  }

  /**
   * Allows us to simulate good/error response for transaction.
   * Note: Should never be enabled on production!!
   *
   * Example:
   * To get a success response we will send 000
   * To get false response we will send the status code we want to simulate
   *
   * @param string $QAResultStatus
   *
   * @throws \InvalidArgumentException
   */
  public function setQAResultStatus($QAResultStatus) {
    if ($QAResultStatus !== NULL && (!is_string($QAResultStatus) || preg_match("/^\d{3}$/", $QAResultStatus) !== 1)) {
      throw new \InvalidArgumentException('Invalid `$QAResultStatus`. Data must be three-digit status code, eg \'000\' or `null` when you need to unset it');
    }
    $this->QAResultStatus = $QAResultStatus;
  }

  /**
   * Return JSON serialized data
   * @return array
   */
  public function jsonSerialize() {
    $serialized = get_object_vars($this);
    if ($serialized['QAResultStatus'] === NULL) {
      unset($serialized['QAResultStatus']);
    }
    return $serialized;
  }

}