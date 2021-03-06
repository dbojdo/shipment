<?php
namespace Webit\Shipment\Vendor;

use Webit\Tools\Serializer\MixedValueWrapper;

class VendorOptionValue implements VendorOptionValueInterface
{
    /**
     * @var string
     */
    protected $optionCode;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param string $optionCode
     * @param mixed $value
     */
    public function __construct($optionCode, $value = null)
    {
        $this->optionCode = $optionCode;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getOptionCode()
    {
        return $this->optionCode;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return ($this->value instanceof MixedValueWrapper) ? $this->value->getValue() : $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
