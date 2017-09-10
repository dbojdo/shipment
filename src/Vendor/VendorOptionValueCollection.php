<?php
/**
 * VendorOptionValueCollection.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@dxi.eu>
 * Created on Dec 22, 2014, 10:05
 * Copyright (C) DXI Ltd
 */

namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;

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

    /**
     * VendorOptionValueCollection constructor.
     * @param VendorOptionValue[] $optionValues
     */
    public function __construct(array $optionValues = array())
    {
        $this->values = new ArrayCollection();

        foreach ($optionValues as $value) {
            $this->addValue($value);
        }
    }

    /**
     * @param VendorOptionValueInterface $option
     */
    public function addValue(VendorOptionValueInterface $option)
    {
        $this->values->set($option->getOptionCode(), $option);
    }

    /**
     * @param VendorOptionValueInterface $option
     */
    public function removeValue(VendorOptionValueInterface $option)
    {
        $this->values->removeElement($option);
    }

    /**
     * @param $optionCode
     * @return VendorOptionValueInterface
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
