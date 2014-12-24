<?php
/**
 * VendorOptionValueCollection.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@dxi.eu>
 * Created on Dec 22, 2014, 10:05
 * Copyright (C) DXI Ltd
 */

namespace Webit\Shipment\Vendor;

/**
 * Class VendorOptionValueCollection
 * @package Webit\Shipment\Vendor
 */
class VendorOptionValueCollection implements \IteratorAggregate, \Countable
{
    /**
     * @var ArrayCollection
     */
    private $values;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

    /**
     * @param VendorOptionInterface $option
     */
    public function addValue(VendorOptionInterface $option)
    {
        $this->values->set($option->getCode(), $option);
    }

    /**
     * @param VendorOptionInterface $option
     */
    public function removeValue(VendorOptionInterface $option)
    {
        $this->values->removeElement($option);
    }

    /**
     * @param $optionCode
     * @return VendorOptionInterface
     */
    public function getValue($optionCode)
    {
        return $this->values->get($optionCode);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values->toArray();
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return $this->values->getIterator();
    }


    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return $this->options->count();
    }
}
