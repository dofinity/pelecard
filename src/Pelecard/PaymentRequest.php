<?php
/**
 * @file PaymentRequest class - defines the structure and defaults for pelecard payment request.
 */
namespace Pelecard\PaymentRequest;

class PaymentRequest implements \JsonSerializable {

  // Authentication info
  private $terminal;
  private $user;
  private $password;

  // Redirect URLs
  private $GoodURL;
  private $ErrorURL;
  private $CancelURL;

  // Currency
  private $ActionType;
  private $Currency;

  // Total
  private $Total;
  private $FreeTotal;

  // Result and Feedback
  private $resultDataKeyName;
  private $ServerSideGoodFeedbackURL;
  private $ServerSideErrorFeedbackURL;

  // Notification emails
  private $NotificationGoodMail;
  private $NotificationErrorMail;
  private $NotificationFailMail;

  // Tokens
  private $CreateToken;
  private $TokenForTerminal;
  private $TokenCreditCardDigits;

  // Form options
  private $Language;
  private $CardHolderName;
  private $CustomerIdField;
  private $Cvv2Field;
  private $EmailField;
  private $TelField;
  private $SplitCCNumber;

  private $IsToken;
  private $FeedbackOnTop;
  private $FeedbackDataTransferMethod;
  private $UseBuildInFeedbackPage;

  // Payment installments
  private $MaxPayments;
  private $MinPayments;
  private $MinPaymentsForCredit;
  private $DisabledPaymentNumbers; // comma separated string of values
  private $FirstPayment; // the amount is in agorot/cents

  // Order identification
  private $AuthNum;
  private $ShopNo;
  private $ParamX;
  private $ShowXParam;
  private $AddHolderNameToXParam;
  private $UserKey;

  // Display options
  private $SetFocus;
  private $CssURL;
  private $TopText;
  private $BottomText;
  private $LogoURL;
  private $ShowConfirmationCheckbox;
  private $TextOnConfirmationBox;
  private $ConfirmationLink;
  private $HiddenPelecardLogo;
  private $AllowedBINs;
  private $BlockedBINs;
  private $ShowSubmitButton;
  private $AccessibilityMode;
  private $TakeIshurPopUp;
  private $SupportedCards; // Supported credit cards

  // Custom field captions
  private $CaptionSet;

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
   * @param string $ParamX
   */
  public function setParamX($ParamX) {
    $this->ParamX = $ParamX;
  }

  /**
   * Sets the supported credit card types.
   * @param mixed $SupportedCards
   */
  public function setSupportedCards($SupportedCards) {
    $this->SupportedCards = $SupportedCards;
  }

  /**
   * Sets custom captions for payment form fields.
   * @param mixed $CaptionSet
   */
  public function setCaptionSet($CaptionSet) {
    $this->CaptionSet = $CaptionSet;
  }

  /**
   * If set to True, iframe integration will assume the iframe redirects directly
   * to the payment site, i.e. the parent window.
   * @param string $FeedbackOnTop
   */
  public function setFeedbackOnTop($FeedbackOnTop) {
    $this->FeedbackOnTop = $FeedbackOnTop ? 'True' : 'False';
  }

  /**
   * Return JSON serialized data
   * @return array
   */
  public function jsonSerialize() {
    return get_object_vars($this);
  }

}