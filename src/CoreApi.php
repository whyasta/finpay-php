<?php

namespace Finpay;

class CoreApi
{
  public static function initiate($params)
  {
    $payloads = array(
      'sourceOfFunds' => array(
        'type' => SourceOfFund::CC,
      ),
      'url' => [
        'callbackUrl' => 'https://sandbox.finpay.co.id/simdev/finpay/result/resultsuccess.php'
      ],
    );

    if (isset($params['order']['item'])) {
      $gross_amount = 0;
      foreach ($params['order']['item'] as $item) {
        $gross_amount += $item['quantity'] * $item['unitPrice'];
      }
      $payloads['order']['amount'] = $gross_amount;
    }

    $payloads = array_replace_recursive($payloads, $params);

    return HttpClient::process(
      'POST',
      'initiate',
      Configuration::getBaseUrl() . '/pg/payment/card/initiate',
      Configuration::getAuthKey(),
      $payloads,
    );
  }

  public static function check($orderId)
  {
    return HttpClient::process(
      'GET',
      'check',
      Configuration::getBaseUrl() . '/pg/payment/card/check/' . $orderId,
      Configuration::getAuthKey(),
      null,
    );
  }

  public static function cancel($orderId)
  {
    return HttpClient::process(
      'GET',
      'cancel',
      Configuration::getBaseUrl() . '/pg/payment/card/cancel/' . $orderId,
      Configuration::getAuthKey(),
      null,
    );
  }

  public static function void($orderId)
  {
    return HttpClient::process(
      'GET',
      'void',
      Configuration::getBaseUrl() . '/pg/payment/card/void/' . $orderId,
      Configuration::getAuthKey(),
      null,
    );
  }

  public static function refund($params)
  {
    return HttpClient::process(
      'GET',
      'refund',
      Configuration::getBaseUrl() . '/pg/payment/card/refund',
      Configuration::getAuthKey(),
      $params,
    );
  }

  public static function openPaymentRegister($params)
  {
    return HttpClient::process(
      'POST',
      'openPaymentRegister',
      Configuration::getBaseUrl() . '/pg/payment/card/openpayment/register',
      Configuration::getAuthKey(),
      $params,
    );
  }

  public static function openPaymentUpdate($params)
  {
    return HttpClient::process(
      'POST',
      'openPaymentUpdate',
      Configuration::getBaseUrl() . '/pg/payment/card/openpayment/update',
      Configuration::getAuthKey(),
      $params,
    );
  }

  public static function openPaymentCheck($params)
  {
    return HttpClient::process(
      'GET',
      'openPaymentCheck',
      Configuration::getBaseUrl() . '/pg/payment/card/openpayment/check',
      Configuration::getAuthKey(),
      $params,
    );
  }

  public static function openPaymentDelete($sofId, $paymentCode)
  {
    return HttpClient::process(
      'GET',
      'openPaymentDelete',
      Configuration::getBaseUrl() . '/pg/payment/card/openpayment/delete/' . $sofId . '/' . $paymentCode,
      Configuration::getAuthKey(),
      null,
    );
  }
}
