<?php
/**
 * Payload
 *
 * PHP version 5
 *
 * @category Class
 * @package  daxslab\enzona\payment
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * PaymentAPI
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: v1.0.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.8
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace daxslab\enzona\payment\model;

use \ArrayAccess;
use \daxslab\enzona\payment\ObjectSerializer;

/**
 * Payload Class Doc Comment
 *
 * @category Class
 * @package  daxslab\enzona\payment
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Payload implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'Payload';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'description' => 'string',
        'currency' => 'string',
        'amount' => '\daxslab\enzona\payment\model\PaymentsAmount',
        'items' => '\daxslab\enzona\payment\model\PaymentsItems[]',
        'merchant_op_id' => 'string',
        'invoice_number' => 'string',
        'return_url' => 'string',
        'cancel_url' => 'string',
        'terminal_id' => 'string',
        'buyer_identity_code' => 'string',
        'merchant_uuid' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'description' => null,
        'currency' => null,
        'amount' => null,
        'items' => null,
        'merchant_op_id' => null,
        'invoice_number' => null,
        'return_url' => null,
        'cancel_url' => null,
        'terminal_id' => null,
        'buyer_identity_code' => null,
        'merchant_uuid' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'description' => 'description',
        'currency' => 'currency',
        'amount' => 'amount',
        'items' => 'items',
        'merchant_op_id' => 'merchant_op_id',
        'invoice_number' => 'invoice_number',
        'return_url' => 'return_url',
        'cancel_url' => 'cancel_url',
        'terminal_id' => 'terminal_id',
        'buyer_identity_code' => 'buyer_identity_code',
        'merchant_uuid' => 'merchant_uuid'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'description' => 'setDescription',
        'currency' => 'setCurrency',
        'amount' => 'setAmount',
        'items' => 'setItems',
        'merchant_op_id' => 'setMerchantOpId',
        'invoice_number' => 'setInvoiceNumber',
        'return_url' => 'setReturnUrl',
        'cancel_url' => 'setCancelUrl',
        'terminal_id' => 'setTerminalId',
        'buyer_identity_code' => 'setBuyerIdentityCode',
        'merchant_uuid' => 'setMerchant_uuid'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'description' => 'getDescription',
        'currency' => 'getCurrency',
        'amount' => 'getAmount',
        'items' => 'getItems',
        'merchant_op_id' => 'getMerchantOpId',
        'invoice_number' => 'getInvoiceNumber',
        'return_url' => 'getReturnUrl',
        'cancel_url' => 'getCancelUrl',
        'terminal_id' => 'getTerminalId',
        'buyer_identity_code' => 'getBuyerIdentityCode',
        'merchant_uuid' => 'getMerchant_uuid'

    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    const CURRENCY_CUP = 'CUP';
    const CURRENCY_CUC = 'CUC';
    const MERCHANT_OP_ID__123456789123 = '123456789123';
    const INVOICE_NUMBER__1212 = '1212';
    const RETURN_URL_HTTPSMYMERCHANTCURETURN = 'https://mymerchant.cu/return';
    const CANCEL_URL_HTTPSMYMERCHANTCUCANCEL = 'https://mymerchant.cu/cancel';
    const TERMINAL_ID__12121 = '12121';



    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCurrencyAllowableValues()
    {
        return [
            self::CURRENCY_CUP,
            self::CURRENCY_CUC,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMerchantOpIdAllowableValues()
    {
        return [
            self::MERCHANT_OP_ID__123456789123,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceNumberAllowableValues()
    {
        return [
            self::INVOICE_NUMBER__1212,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getReturnUrlAllowableValues()
    {
        return [
            self::RETURN_URL_HTTPSMYMERCHANTCURETURN,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCancelUrlAllowableValues()
    {
        return [
            self::CANCEL_URL_HTTPSMYMERCHANTCUCANCEL,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTerminalIdAllowableValues()
    {
        return [
            self::TERMINAL_ID__12121,
        ];
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['items'] = isset($data['items']) ? $data['items'] : null;
        $this->container['merchant_op_id'] = isset($data['merchant_op_id']) ? $data['merchant_op_id'] : null;
        $this->container['invoice_number'] = isset($data['invoice_number']) ? $data['invoice_number'] : null;
        $this->container['return_url'] = isset($data['return_url']) ? $data['return_url'] : null;
        $this->container['cancel_url'] = isset($data['cancel_url']) ? $data['cancel_url'] : null;
        $this->container['terminal_id'] = isset($data['terminal_id']) ? $data['terminal_id'] : null;
        $this->container['buyer_identity_code'] = isset($data['buyer_identity_code']) ? $data['buyer_identity_code'] : null;
        $this->container['merchant_uuid'] = isset($data['merchant_uuid']) ? $data['merchant_uuid'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        //        $allowedValues = $this->getCurrencyAllowableValues();
//        if (!is_null($this->container['currency']) && !in_array($this->container['currency'], $allowedValues, true)) {
//            $invalidProperties[] = sprintf(
//                "invalid value for 'currency', must be one of '%s'",
//                implode("', '", $allowedValues)
//            );
//        }
//
//        $allowedValues = $this->getMerchantOpIdAllowableValues();
//        if (!is_null($this->container['merchant_op_id']) && !in_array($this->container['merchant_op_id'], $allowedValues, true)) {
//            $invalidProperties[] = sprintf(
//                "invalid value for 'merchant_op_id', must be one of '%s'",
//                implode("', '", $allowedValues)
//            );
//        }
//
//        $allowedValues = $this->getInvoiceNumberAllowableValues();
//        if (!is_null($this->container['invoice_number']) && !in_array($this->container['invoice_number'], $allowedValues, true)) {
//            $invalidProperties[] = sprintf(
//                "invalid value for 'invoice_number', must be one of '%s'",
//                implode("', '", $allowedValues)
//            );
//        }
//
//        $allowedValues = $this->getReturnUrlAllowableValues();
//        if (!is_null($this->container['return_url']) && !in_array($this->container['return_url'], $allowedValues, true)) {
//            $invalidProperties[] = sprintf(
//                "invalid value for 'return_url', must be one of '%s'",
//                implode("', '", $allowedValues)
//            );
//        }
//
//        $allowedValues = $this->getCancelUrlAllowableValues();
//        if (!is_null($this->container['cancel_url']) && !in_array($this->container['cancel_url'], $allowedValues, true)) {
//            $invalidProperties[] = sprintf(
//                "invalid value for 'cancel_url', must be one of '%s'",
//                implode("', '", $allowedValues)
//            );
//        }
//
//        $allowedValues = $this->getTerminalIdAllowableValues();
//        if (!is_null($this->container['terminal_id']) && !in_array($this->container['terminal_id'], $allowedValues, true)) {
//            $invalidProperties[] = sprintf(
//                "invalid value for 'terminal_id', must be one of '%s'",
//                implode("', '", $allowedValues)
//            );
//        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    public function getMerchant_uuid()
    {
        return $this->container['merchant_uuid'];
    }
    public function setMerchant_uuid($merchant_uuid)
    {
        $this->container['merchant_uuid'] = $merchant_uuid;

        return $this;
    }
    /**
     * Gets currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string $currency currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $allowedValues = $this->getCurrencyAllowableValues();
        //        if (!is_null($currency) && !in_array($currency, $allowedValues, true)) {
//            throw new \InvalidArgumentException(
//                sprintf(
//                    "Invalid value for 'currency', must be one of '%s'",
//                    implode("', '", $allowedValues)
//                )
//            );
//        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return \daxslab\enzona\payment\model\PaymentsAmount
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param \daxslab\enzona\payment\model\PaymentsAmount $amount amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets items
     *
     * @return \daxslab\enzona\payment\model\PaymentsItems[]
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \daxslab\enzona\payment\model\PaymentsItems[] $items items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets merchant_op_id
     *
     * @return string
     */
    public function getMerchantOpId()
    {
        return $this->container['merchant_op_id'];
    }

    /**
     * Sets merchant_op_id
     *
     * @param string $merchant_op_id merchant_op_id
     *
     * @return $this
     */
    public function setMerchantOpId($merchant_op_id)
    {
        $allowedValues = $this->getMerchantOpIdAllowableValues();
        //        if (!is_null($merchant_op_id) && !in_array($merchant_op_id, $allowedValues, true)) {
//            throw new \InvalidArgumentException(
//                sprintf(
//                    "Invalid value for 'merchant_op_id', must be one of '%s'",
//                    implode("', '", $allowedValues)
//                )
//            );
//        }
        $this->container['merchant_op_id'] = $merchant_op_id;

        return $this;
    }

    /**
     * Gets invoice_number
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string $invoice_number invoice_number
     *
     * @return $this
     */
    public function setInvoiceNumber($invoice_number)
    {
        $allowedValues = $this->getInvoiceNumberAllowableValues();
        //        if (!is_null($invoice_number) && !in_array($invoice_number, $allowedValues, true)) {
//            throw new \InvalidArgumentException(
//                sprintf(
//                    "Invalid value for 'invoice_number', must be one of '%s'",
//                    implode("', '", $allowedValues)
//                )
//            );
//        }
        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets return_url
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->container['return_url'];
    }

    /**
     * Sets return_url
     *
     * @param string $return_url return_url
     *
     * @return $this
     */
    public function setReturnUrl($return_url)
    {
        $allowedValues = $this->getReturnUrlAllowableValues();
        //        if (!is_null($return_url) && !in_array($return_url, $allowedValues, true)) {
//            throw new \InvalidArgumentException(
//                sprintf(
//                    "Invalid value for 'return_url', must be one of '%s'",
//                    implode("', '", $allowedValues)
//                )
//            );
//        }
        $this->container['return_url'] = $return_url;

        return $this;
    }

    /**
     * Gets cancel_url
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->container['cancel_url'];
    }

    /**
     * Sets cancel_url
     *
     * @param string $cancel_url cancel_url
     *
     * @return $this
     */
    public function setCancelUrl($cancel_url)
    {
        $allowedValues = $this->getCancelUrlAllowableValues();
        //        if (!is_null($cancel_url) && !in_array($cancel_url, $allowedValues, true)) {
//            throw new \InvalidArgumentException(
//                sprintf(
//                    "Invalid value for 'cancel_url', must be one of '%s'",
//                    implode("', '", $allowedValues)
//                )
//            );
//        }
        $this->container['cancel_url'] = $cancel_url;

        return $this;
    }

    /**
     * Gets terminal_id
     *
     * @return string
     */
    public function getTerminalId()
    {
        return $this->container['terminal_id'];
    }

    /**
     * Sets terminal_id
     *
     * @param string $terminal_id terminal_id
     *
     * @return $this
     */
    public function setTerminalId($terminal_id)
    {
        $allowedValues = $this->getTerminalIdAllowableValues();
        //        if (!is_null($terminal_id) && !in_array($terminal_id, $allowedValues, true)) {
//            throw new \InvalidArgumentException(
//                sprintf(
//                    "Invalid value for 'terminal_id', must be one of '%s'",
//                    implode("', '", $allowedValues)
//                )
//            );
//        }
        $this->container['terminal_id'] = $terminal_id;

        return $this;
    }

    /**
     * Gets buyer_identity_code
     *
     * @return string
     */
    public function getBuyerIdentityCode()
    {
        return $this->container['buyer_identity_code'];
    }

    /**
     * Sets buyer_identity_code
     *
     * @param string $buyer_identity_code buyer_identity_code
     *
     * @return $this
     */
    public function setBuyerIdentityCode($buyer_identity_code)
    {
        $this->container['buyer_identity_code'] = $buyer_identity_code;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}