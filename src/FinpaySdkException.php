<?php

/**
 * FinpaySdkException
 * PHP version 7.4
 *
 * @category Class
 * @package  Finpay
 */

/**
 * Payment Requests
 *
 * The version of the OpenAPI document: 1.70.0
 */

/**
 * NOTE: This class is auto generated.
 * Do not edit the class manually.
 */

namespace Finpay;

use \Exception;

/**
 * FinpaySdkException Class Doc Comment
 *
 * @category Class
 * @package  Finpay
 */
class FinpaySdkException extends Exception
{
  protected $status;

  /**
   * Raw Response body from server. Useful for debugging when needed or when the error given is unclear
   *
   * @var \stdClass|string|null
   */
  protected $rawResponse;

  /**
   * Raw Response body from server. Useful for debugging when needed or when the error given is unclear
   *
   * @var string|null
   */
  protected $responseCode;

  /**
   * Raw Response body from server. Useful for debugging when needed or when the error given is unclear
   *
   * @var string|null
   */
  protected $responseMessage;


  /**
   * Constructor
   *
   * @param \stdClass|null                $rawResponse         Response Body
   * @param string|null                   $paramStatus            HTTP status code of the Response
   * @param string|null         $paramStatusText HTTP Message if any
   */
  public function __construct($rawResponse, $paramStatus, $paramStatusText)
  {
    if ($rawResponse === null) {
      $rawResponse = "";
    }
    $_status = $paramStatus;
    $_responseCode = "";
    $_responseMessage = "";

    if (property_exists($rawResponse, "responseCode")) {
      $_responseCode = $rawResponse->responseCode;
    }
    if (property_exists($rawResponse, "response_code")) {
      $_responseCode = $rawResponse->response_code;
    }

    if ($_responseMessage === "" && property_exists($rawResponse, "response_message")) {
      $_responseMessage = $rawResponse->response_message;
    }
    if ($_responseMessage === "" && property_exists($rawResponse, "responseMessage")) {
      $_responseMessage = $rawResponse->responseMessage;
    }
    if ($_responseMessage === "") {
      $_responseMessage = $paramStatusText;
    }

    parent::__construct($_responseMessage, intval($paramStatus));

    sprintf($_responseCode);

    $this->rawResponse = $rawResponse;
    $this->status = $_status;
    $this->responseCode = $_responseCode;
    $this->responseMessage = $_responseMessage;
  }

  /**
   * Gets the raw response from server
   *
   * @return \stdClass|string|null
   */
  public function getRawResponse()
  {
    return $this->rawResponse;
  }

  /**
   * Gets HTTP status code (2xx, 4xx, 5xx, etc)
   *
   * @return string|null
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Gets Finpay Error Code
   *
   * @return string|null
   */
  public function getResponseCode()
  {
    return $this->responseCode;
  }

  /**
   * Gets Finpay Error Message
   *
   * @return string|null
   */
  public function getResponseMessage()
  {
    return $this->responseMessage;
  }

  /**
   * Gets Full Error, useful for debugging
   *
   * @return \stdClass
   */
  public function getFullError()
  {
    return (object) [
      'status' => $this->status,
      'responseCode' => $this->responseCode,
      'responseMessage' => $this->responseMessage,
      'rawResponse' => $this->rawResponse
    ];
  }
}
