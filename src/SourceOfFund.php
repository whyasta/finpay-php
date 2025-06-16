<?php

namespace Finpay;

class SourceOfFund
{
  // source of fund constants
  public const ALFAMART = 'alfamart';
  public const CC = 'cc';
  public const DANA = 'dana';
  public const FINPAY_BPD = 'finpaybpd';
  public const FINPAY_CODE = 'finpaycode';
  public const FINPAY_MONEY = 'finpaymoney';
  public const IDM = 'idm';
  public const INDODANA = 'indodana';
  public const JENIUSPAY = 'jeniuspay';
  public const KREDIVO = 'kredivo';
  public const LINKAJA = 'linkaja';
  public const LINKAJA_WCO = 'linkajawco';
  public const OCTO_CLICKS = 'octoclicks';
  public const OVO = 'ovo';
  public const PERMATA_NET = 'permatanet';
  public const POSPAY = 'pospay';
  public const QRIS = 'qris';
  public const SHOPEEPAY = 'shopeepay';
  public const VA_BCA = 'vabca';
  public const VA_BJB = 'vabjb';
  public const VA_BNC = 'vabnc';
  public const VA_BNI = 'vabni';
  public const VA_BRI = 'vabri';
  public const VA_BSI = 'vabsi';
  public const VA_BTN = 'vabtn';
  public const VA_DKI = 'vadki';
  public const VA_MANDIRI = 'vamandiri';
  public const VA_MAYBANK = 'vamaybank';
  public const VA_MEGA = 'vamega';
  public const VA_MUAMALAT = 'vamuamalat';
  public const VA_NAGARI = 'vanagari';
  public const VA_PERMATA = 'vapermata';
  public const VIRGO = 'virgo';

  /**
   * Mapping of source of fund codes to their names
   */
  private const METHOD_NAMES = [
    self::ALFAMART => 'Alfamart',
    self::CC => 'Credit / Debit Card',
    self::DANA => 'DANA',
    self::FINPAY_BPD => 'Finpay BPD',
    self::FINPAY_CODE => 'Finpay Payment Code',
    self::FINPAY_MONEY => 'Finpay Money',
    self::IDM => 'Indomaret',
    self::INDODANA => 'Indodana',
    self::JENIUSPAY => 'Jenius Pay',
    self::KREDIVO => 'Kredivo',
    self::LINKAJA => 'LinkAja Applink',
    self::LINKAJA_WCO => 'LinkAja Web Checkout',
    self::OCTO_CLICKS => 'OCTO Clicks',
    self::OVO => 'Ovo',
    self::PERMATA_NET => 'PermataNet',
    self::POSPAY => 'Pospay',
    self::QRIS => 'QRIS',
    self::SHOPEEPAY => 'ShopeePay',
    self::VA_BCA => 'Virtual Account BCA',
    self::VA_BJB => 'Virtual Account BJB',
    self::VA_BNC => 'Virtual Account BNC',
    self::VA_BNI => 'Virtual Account BNI',
    self::VA_BRI => 'Virtual Account BRI',
    self::VA_BSI => 'Virtual Account BSI',
    self::VA_BTN => 'Virtual Account BTN',
    self::VA_DKI => 'Virtual Account Bank DKI',
    self::VA_MANDIRI => 'Virtual Account Mandiri',
    self::VA_MAYBANK => 'Virtual Account Maybank',
    self::VA_MEGA => 'Virtual Account Mega',
    self::VA_MUAMALAT => 'Virtual Account Muamalat',
    self::VA_NAGARI => 'Virtual Account Nagari',
    self::VA_PERMATA => 'Virtual Account Permata',
    self::VIRGO => 'Virgo'
  ];

  /**
   * Get all available source of funds
   */
  public static function all(): array
  {
    return self::METHOD_NAMES;
  }

  /**
   * Get source of fund name by code
   */
  public static function getName(string $code): ?string
  {
    return self::METHOD_NAMES[$code] ?? null;
  }

  /**
   * Check if source of fund exists
   */
  public static function exists(string $code): bool
  {
    return isset(self::METHOD_NAMES[$code]);
  }

  /**
   * Get all source of fund codes
   */
  public static function codes(): array
  {
    return array_keys(self::METHOD_NAMES);
  }

  /**
   * Get all source of fund names
   */
  public static function names(): array
  {
    return array_values(self::METHOD_NAMES);
  }

  /**
   * Get source of funds as options for dropdown/select
   */
  public static function options(): array
  {
    return self::METHOD_NAMES;
  }
}
