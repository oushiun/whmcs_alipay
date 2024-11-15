<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function alipay_MetaData()
{
    return array(
        'DisplayName' => '支付宝',
        'APIVersion' => '1.1', // Use API Version 1.1
    );
}

function alipay_config()  
{
    require_once __DIR__ ."/alipay/alipay.config.php";
    $config = new alipay_config();
    return $config->get_configuration();
}

function alipay_link($params)
{
    require_once __DIR__ ."/alipay/alipay.link.php";
    $link = new alipay_link();
    return $link->get_paylink($params);
}