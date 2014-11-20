<?php
/**
 * VendorOptionInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 14:48
 */

namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface VendorOptionInterface
 * @package Webit\Shipment\Vendor
 */
interface VendorOptionInterface
{

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return ArrayCollection
     */
    public function getAllowedValues();

    /**
     * @param mixed $value
     */
    public function addAllowedValue($value);

    /**
     * @param mixed $value
     */
    public function removeAllowedValue($value);

    /**
     * @param mixed $value
     * @return bool
     */
    public function isAllowedValue($value);
}
