[![Maintainability](https://api.codeclimate.com/v1/badges/a129f7c59d8ec641af79/maintainability)](https://codeclimate.com/github/dofinity/pelecard/maintainability)

# pelecard
A lightweight PHP Helper Library for integrating Pelecard Iframe V2 payments.

## Installation with Composer
```shell
$ composer require dofinity/pelecard:dev-master
```

## Basic usage

### Payment page setup
```php
require __DIR__ . '/vendor/autoload.php';

// change terminal, user and password to real credentials
$terminal = '0123456';
$user = 'user';
$password = 'password';

// change to your own callback url
$GoodURL = 'http://yourdomain/callback.php';
$Total = 100;

// PaymentRequest accepts a lot of params, but in this case we use only required ones
$PaymentRequest = new \Pelecard\PaymentRequest(
    $terminal, $user, $password, $GoodURL, $Total
);

$payment = new \Pelecard\PelecardPayment();
$payment->setPaymentRequest($PaymentRequest);
$result = $payment->SubmitPaymentRequest();
$resultJson = json_decode($result, true);

$URL = $resultJson['URL'];
$ConfirmationKey = $resultJson['ConfirmationKey'];
$Error = $resultJson['Error'];

// redirect to payment page
header("Location: {$URL}");
```

### Payment validation
```php
// callback.php
require __DIR__ . '/vendor/autoload.php';

$PelecardTransactionId = $_GET['PelecardTransactionId'];
$PelecardStatusCode = $_GET['PelecardStatusCode'];
$ConfirmationKey = $_GET['ConfirmationKey'];
$Total = 100;

$PaymentResponse = new \Pelecard\PaymentResponse(
    $PelecardStatusCode, $PelecardTransactionId, '', '', $ConfirmationKey, 100
);

$payment = new \Pelecard\PelecardPayment();
$payment->setPaymentResponse($PaymentResponse);

if ($payment->ValidatePayment()) {
    echo 'Ok. Payment has been verified';
} else {
    echo 'Fail. Payment forged';
}
```

### Retrieve Transaction info
```php
// callback.php
require __DIR__ . '/vendor/autoload.php';

// change terminal, user and password to real credentials
$terminal = '0123456';
$user = 'user';
$password = 'password';

$PelecardTransactionId = $_GET['PelecardTransactionId'];

$transaction = new \Pelecard\PelecardTransaction(
    $terminal, $user, $password, $PelecardTransactionId
);

// use properties from src/Pelecard/PelecardTransaction.php class
var_dump($transaction);
```
