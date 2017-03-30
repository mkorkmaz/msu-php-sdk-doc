## Options

Action Name | Action | Parameters
:----------- |:-------------:| :-----------
Session Token  |session_token | CUSTOMER, SESSIONTYPE, RETURNURL, MERCHANTPAYMENTID, AMOUNT, CURRENCY, CUSTOMEREMAIL, CUSTOMERNAME, CUSTOMERPHONE, CUSTOMERIP, CUSTOMERUSERAGENT, SESSIONEXPIRY, LANGUAGE, CAMPAIGNCODE, ORDERITEMS, TMXSESSIONQUERYINPUT, EXTRA, MAXINSTALLMENTCOUNT, SPLITPAYMENTTYPE
Session Extend  |session_extend | TOKEN, SESSIONEXPIRY



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