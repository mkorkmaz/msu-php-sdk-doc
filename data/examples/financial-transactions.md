## Sale Action Example

```php
$args = [
    'MERCHANTPAYMENTID' => $orderPaymetId,
    'CUSTOMER' => '1',
    'AMOUNT' => 123.50,
    'CURRENCY' => 'TRY',
    'CUSTOMEREMAIL' => 'mehmet@github.com',
    'CUSTOMERNAME' => 'Mehmet Korkmaz',
    'CUSTOMERIP'    => '127.0.0.1',
    'CARDPAN' => '5406675406675403', // Test Card Number
    'CARDEXPIRY' => '12.30',
    'NAMEONCARD' => 'MEHMET KORKMAZ',
    'CARDCVV' => '000'
];
$response = $client->financialTransactions('sale', $args);

echo $response['data']['responseCode']; // prints '00' which means transaction has been done successfully.

```

## Pre Auth Action Example

```php
$args = [
    'MERCHANTPAYMENTID' => $orderPaymetId,
    'CUSTOMER' => '1',
    'AMOUNT' => 123.50,
    'CURRENCY' => 'TRY',
    'CUSTOMEREMAIL' => 'mehmet@github.com',
    'CUSTOMERNAME' => 'Mehmet Korkmaz',
    'CUSTOMERIP'    => '127.0.0.1',
    'CARDPAN' => '5406675406675403', // Test Card Number
    'CARDEXPIRY' => '12.30',
    'NAMEONCARD' => 'MEHMET KORKMAZ',
    'CARDCVV' => '000'
];
$response = $client->financialTransactions('pre_auth', $args);

echo $response['data']['responseCode']; // prints '00' which means pre auth has been done successfully.

```