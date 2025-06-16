<?php

namespace Finpay\Tests;

use Finpay\Configuration;
use Finpay\CoreApi;
use Finpay\FinpaySdkException;
use Finpay\Hosted;
use Finpay\SourceOfFund;
use Finpay\Utils;
use PHPUnit\Framework\TestCase;

class CoreApiTest extends TestCase
{
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
      ],
      'sourceOfFund' => [
        'type' => SourceOfFund::VA_BCA,
      ]
    ];

    Configuration::$debug = false;
    Configuration::$merchantUsername = "FINPAY770";
    Configuration::$merchantKey = "mykey";

    $initiate = Hosted::initiate($params);

    $this->assertEquals($initiate->responseCode, "2000000");
  }

  public function testWithInvalidKey()
  {
    Configuration::$debug = false;
    Configuration::$merchantUsername = "FINPAY770";
    Configuration::$merchantKey = "1233333";

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
      ],
      'sourceOfFund' => [
        'type' => SourceOfFund::VA_BCA,
      ]
    ];
    try {
      $initiate = CoreApi::initiate($params);
    } catch (FinpaySdkException $error) {
      $this->assertEquals($error->getResponseCode(), "4010000");
    }
  }

  public function testWithInvalidParams()
  {
    Configuration::$debug = false;
    Configuration::$merchantUsername = "FINPAY770";
    Configuration::$merchantKey = "mykey";

    $params = [
      'order' => [
        'id' => Utils::generateUuid(),
        'amount' => 100000,
        'description' => 'ORDER-123',
      ],
      'sourceOfFund' => [
        'type' => SourceOfFund::VA_BCA,
      ]
    ];
    try {
      $initiate = CoreApi::initiate($params);
    } catch (FinpaySdkException $error) {
      $this->assertEquals($error->getResponseCode(), "4000001");
    }
  }
}
