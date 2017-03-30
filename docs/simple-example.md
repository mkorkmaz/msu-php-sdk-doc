## Configuration

```php

$env = 'https://test.merchantsafeunipay.com/msu/api/v2'; 
$merchant = 'COMPANYNAME'; // Given by Asseco
$merchantUser = 'apiuser@companyname.com'; // Created on MSU Panel
$merchantPassword = 'u+B56?mcjh23'; // Created on MSU Panel
```

## Creating API Client

```php
$client = MerchantSafeUnipay\SDK\ClientBuilder::create()
    ->setEnvironment($env, $merchant , $merchantUser, $merchantPassword)
    ->setLogger()
    ->build();
```

## Sale Transaction Example

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