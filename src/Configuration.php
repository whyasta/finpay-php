<?php

namespace Finpay;

class Configuration
{
  private static $defaultConfiguration;

  public static $isLiveMode = false;

  public static $merchantUsername = '';
  public static $merchantKey = '';
  public static $host = '';
  public static $debug = false;
  public static $debugFile = 'php://output';

  const SANDBOX_BASE_URL = 'https://devo.finnet.co.id';
  const PRODUCTION_BASE_URL = 'https://live.finnet.co.id';


  public static function getBaseUrl()
  {
    return Configuration::$isLiveMode ?
      Configuration::PRODUCTION_BASE_URL : Configuration::SANDBOX_BASE_URL;
  }

  public static function getAuthKey()
  {
    return 'Basic ' . base64_encode(Configuration::$merchantUsername . ':' . Configuration::$merchantKey);
  }

  public static function getDefaultConfiguration()
  {
    if (self::$defaultConfiguration === null) {
      self::$defaultConfiguration = new Configuration();
    }

    return self::$defaultConfiguration;
  }
}
