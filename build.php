<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/msu-php-sdk/vendor/autoload.php';

function getMethodNames($reflectionObject) {
    $methods = $reflectionObject->getMethods();
    $m = [];
    foreach ($methods as $method) {
        $m[] = $method->name;
    }
    return $m;
}

$actionGroups= [
    'session',
    'financialTransactions',
    'approveActions',
    'rejectActions',
    'dealer',
    'dealerPst',
    'dealerType',
    'eWallet',
    'merchant',
    'merchantUser',
    'messageContent',
    'payByLinkPayment',
    'paymentPolicy',
    'paymentSystem',
    'paymentType',
    'recurringPayment',
    'recurringPlan',
    'recurringPlanCard'
];
$validQueryActions = [
    'Transaction',
    'DealerTransaction',
    'SubDealerTransaction',
    'Installment',
    'Card',
    'CardExpiry',
    'Customer',
    'Session',
    'PayByLinkPayment',
    'Bin',
    'Campaign',
    'OnlineCampaign',
    'RecurringPlan',
    'PaymentSystems',
    'MerchantPaymentSystems',
    'MerchantProfile',
    'PaymentSystemData',
    'Points',
    'PaymentPolicy',
    'SplitPayment',
    'Merchant',
    'MerchantContent',
    'MerchantStatusHistory',
    'MerchantUser',
    'UserRolePermission',
    'Dealer',
    'DealerType',
    'DealerPst',
    'DealerStatusHistory',
    'MerchantUserDealers',
    'Groups',
    'ExecutiveReport',
    'TransactionRule'
];
$merchant = [];
$standardMethods = [
    '__construct',
    'getHeaders',
    'getAction',
    'getHeaders',
    'getQueryParams'
];
$docData= [];

foreach ($actionGroups as $actionGroup) {
    $actionClass = '\\MerchantSafeUnipay\\SDK\Action\\' . ucfirst($actionGroup);
    $docData[$actionGroup] = [
        'class_name' => $actionClass,
        'actions' => []
    ];
    $action = new ReflectionClass($actionClass);
    $actionObject = $action->newInstance($merchant);
    $methods = array_diff(getMethodNames($action), $standardMethods);
    foreach ($methods as $method) {
        $property = $action->getProperty($method.'Keys');
        $property->setAccessible(True);
        $value = $property->getValue($actionObject);
        $docData[$actionGroup]['actions'][$method]['parameters'] = $value;
        $actionObject->{$method}([]);
        $docData[$actionGroup]['actions'][$method]['action'] = MerchantSafeUnipay\convertCamelCase($method);
    }
}

foreach ($validQueryActions as $queryAction) {
    $actionClass = '\\MerchantSafeUnipay\\SDK\Action\\Query\\' . $queryAction;
    $docData['query'][$queryAction] = [
        'class_name' => $actionClass,
        'actions' => []
    ];
    $action = new ReflectionClass($actionClass);
    $actionObject = $action->newInstance($merchant);
    $properties = $action->getStaticProperties();
    $docData['query']['actions'][$queryAction]['parameters'] = $properties['queryParamKeys'];
    $docData['query']['actions'][$queryAction]['action'] = MerchantSafeUnipay\convertCamelCase($queryAction);
}
$optionsTemplate = file_get_contents(__DIR__ . '/data/options_template.md');
foreach ($docData as $actionGroup => $actionGroupData) {
    $optionsData = '';
    touch(__DIR__ . '/data/examples/' . MerchantSafeUnipay\convertCamelCase($actionGroup, '-').'.md');
    foreach ($actionGroupData['actions'] as $action=> $actionData) {
        $optionsData .= ucwords(MerchantSafeUnipay\convertCamelCase($action, ' ')) . '  |'. $actionData['action'].' | '. implode(', ', $actionData['parameters'])."\n";
    }
    $optionsContent = str_replace('{options}', $optionsData, file_get_contents(__DIR__.'/data/options_template.md'));
    file_put_contents(__DIR__.'/data/options/' . MerchantSafeUnipay\convertCamelCase($actionGroup, '-').'.md', $optionsContent);
}
$files = glob(__DIR__.'/data/options/*.md');
foreach ($files as $file) {
    $optionsData = file_get_contents($file);
    $exampleData = file_get_contents(__DIR__.'/data/examples/'.basename($file));
    file_put_contents(__DIR__.'/docs/api/'.basename($file), $optionsData . $exampleData);
}