<?php

namespace Webit\Shipment\Vendor;

class VendorOptionValue implements VendorOptionValueInterface
{
    /**
     * @var VendorOptionInterface
     */
    protected $option;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param VendorOptionInterface $option
     */
    public function __construct(VendorOptionInterface $option)
    {
        $this->option = $option;
    }

    /**
     * @return VendorOptionInterface
     */
    public function getOption()
    {
        return $this->option;
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
