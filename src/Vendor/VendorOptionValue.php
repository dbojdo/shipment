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
     * @var MixedValueWrapper
     */
    protected $value;

    /**
     * @param string $optionCode
     */
    public function __construct($optionCode)
    {
        $this->optionCode = $optionCode;
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
        return $this->value instanceof MixedValueWrapper ? $this->value->getValue() : $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = MixedValueWrapper::create($value);
    }
}
