<?php
/**
 * VendorOption.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@dxi.eu>
 * Created on Nov 21, 2014, 15:00
 * Copyright (C) DXI Ltd
 */

namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class VendorOption
 * @package Webit\Shipment\Vendor
 */
class VendorOption implements VendorOptionInterface
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var ArrayCollection
     */
    protected $allowedValues;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return ArrayCollection
     */
    public function getAllowedValues()
    {
        if ($this->allowedValues == null) {
            $this->allowedValues = new ArrayCollection();
        }

        return $this->allowedValues;
    }

    /**
     * @param mixed $value
     */
    public function addAllowedValue($value)
    {
        if (! $this->getAllowedValues()->contains($value)) {
            $this->getAllowedValues()->add($value);
        }
    }

    /**
     * @param mixed $value
     */
    public function removeAllowedValue($value)
    {
        if ($this->getAllowedValues()->contains($value)) {
            $this->getAllowedValues()->removeElement($value);
        }
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isAllowedValue($value)
    {
        $allowedValues = $this->getAllowedValues();

        return $allowedValues->count() == 0 || $allowedValues->contains($value);
    }
}
