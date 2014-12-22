<?php
/**
 * VendorOptionCollection.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@dxi.eu>
 * Created on Dec 22, 2014, 10:03
 * Copyright (C) DXI Ltd
 */

namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class VendorOptionCollection
 * @package Webit\Shipment\Vendor
 */
class VendorOptionCollection implements \IteratorAggregate
{
    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @param VendorOptionInterface $option
     */
    public function addOption(VendorOptionInterface $option)
    {
        $this->options->set($option->getCode(), $option);
    }

    /**
     * @param VendorOptionInterface $option
     */
    public function removeOption(VendorOptionInterface $option)
    {
        $this->options->removeElement($option);
    }

    /**
     * @param $optionCode
     * @return VendorOptionInterface
     */
    public function getOption($optionCode)
    {
        return $this->options->get($optionCode);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options->toArray();
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return $this->options->getIterator();
    }
}
