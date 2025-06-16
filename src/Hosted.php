<?php

namespace Finpay;

class Hosted
{
  public static function initiate($params)
  {
    $payloads = [
      'url' => [
        'callbackUrl' => 'https://sandbox.finpay.co.id/simdev/finpay/result/resultsuccess.php'
      ]
    ];
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

  public static function getRedirectUrl($params)
  {
    return (Hosted::initiate($params)->redirecturl);
  }
}
