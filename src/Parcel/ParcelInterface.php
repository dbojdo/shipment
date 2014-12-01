<?php
/**
 * ParcelInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 14:59
 */

namespace Webit\Shipment\Parcel;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Consignment\ConsignmentInterface;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

/**
 * Class ParcelInterface
 * @package Webit\Shipment\Parcel
 */
interface ParcelInterface
{
    /**
     * @return ConsignmentInterface
     */
    public function getConsignment();

    /**
     * @param ConsignmentInterface $consignment
     */
    public function setConsignment(ConsignmentInterface $consignment);

    /**
     * @return string
     */
    public function getNumber();

    /**
     * @param string $number
     */
    public function setNumber($number);

    /**
     * @return float
     */
    public function getWeight();

    /**
     * @param float $weight
     */
    public function setWeight($weight);

    /**
     * @return string
     */
    public function getReference();

    /**
     * @param string $reference
     */
    public function setReference($reference);

    /**
     * @return ArrayCollection
     */
    public function getVendorOptions();

    /**
     * @param string $code
     * @return VendorOptionValueInterface
     */
    public function getVendorOption($code);

    /**
     * @param VendorOptionValueInterface $vendorOptionValue
     */
    public function setVendorOption(VendorOptionValueInterface $vendorOptionValue);

    /**
     * @param VendorOptionValueInterface $vendorOptionValue
     */
    public function unsetVendorOption(VendorOptionValueInterface $vendorOptionValue);
}
