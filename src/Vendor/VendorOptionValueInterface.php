<?php
/**
 * VendorOptionValueInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 14:50
 */

namespace Webit\Shipment\Vendor;

/**
 * Class VendorOptionValueInterface
 * @package Webit\Shipment\Vendor
 */
interface VendorOptionValueInterface
{
    /**
     * @return VendorOptionInterface
     */
    public function getOption();

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     */
    public function setValue($value);
}
 