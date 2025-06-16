<?php

namespace Finpay;

class Utils
{
  public static function generateUuid()
  {
    $bytes = function_exists('random_bytes')
      ? random_bytes(16)
      : openssl_random_pseudo_bytes(16);

    $bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40); // UUID version 4
    $bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80); // UUID variant 1

    $hex = bin2hex($bytes);

    return implode('-', [
      substr($hex, 0, 8),
      substr($hex, 8, 4),
      substr($hex, 12, 4),
      substr($hex, 16, 4),
      substr($hex, 20, 12)
    ]);
  }
}
