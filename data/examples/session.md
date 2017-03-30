
## Example


```php

$args = [
    'SESSIONTYPE' => 'PAYMENTSESSION',
    'CUSTOMER' => '1',
    'RETURNURL' => 'https://mysite.com/msu_return.php',
    'MERCHANTPAYMENTID' => $paymentID,
    'AMOUNT' => 123.50,
    'CURRENCY' => 'TRY'
];
$response = $client->session('sessionToken', $args);

$args = [
    'TOKEN' => 'HZ3JBAFJ72AJTWRR75JOKWTFHMVHG7Y6UH6VTAGABLMV7LID',
    'SESSIONEXPIRY' => '168h'
];

$response = $client->session('sessionExtend', $args);

```