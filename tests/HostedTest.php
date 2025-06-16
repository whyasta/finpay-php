<?php

namespace Finpay\Tests;

use Finpay\Configuration;
use Finpay\Hosted;
use Finpay\Utils;
use PHPUnit\Framework\TestCase;

class HostedTest extends TestCase
{
  protected $httpClientMock;
  protected $configurationMock;

  public function testInitiate()
  {
    $params = [
      'order' => [
        'id' => Utils::generateUuid(),
        'amount' => 100000,
        'description' => 'ORDER-123',
      ],
      'customer' => [
        'email' => 'hajar.finnet@gmail.com',
        'firstName' => 'Hajar',
        'lastName' => 'Ismail',
        'mobilePhone' => '+6281286288844'
      ]
    ];

    Configuration::$debug = false;
    Configuration::$merchantUsername = getenv('MERCHANT_USERNAME');
    Configuration::$merchantKey = getenv('MERCHANT_KEY');

    $initiate = Hosted::initiate($params);

    $this->assertEquals($initiate->responseCode, "2000000");
  }

  public function testInitiateWithRedirectUrl()
  {
    $params = [
      'order' => [
        'id' => Utils::generateUuid(),
        'amount' => 100000,
        'description' => 'ORDER-123',
      ],
      'customer' => [
        'email' => 'hajar.finnet@gmail.com',
        'firstName' => 'Hajar',
        'lastName' => 'Ismail',
        'mobilePhone' => '+6281286288844'
      ]
    ];

    Configuration::$debug = false;
    Configuration::$merchantUsername = getenv('MERCHANT_USERNAME');
    Configuration::$merchantKey = getenv('MERCHANT_KEY');

    $redirectUrl = Hosted::getRedirectUrl($params);

    $this->assertMatchesRegularExpression(
      '@^https://devo\.finpay\.id/pg/payment/card@',
      $redirectUrl,
      "URL does not match expected pattern"
    );
  }
}
