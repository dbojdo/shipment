<?php
namespace Webit\Shipment\Vendor;

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
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
