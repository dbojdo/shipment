<?php
/**
 * VendorInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 14:47
 */

namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class VendorInterface
 * @package Webit\Shipment\Vendor
 */
interface VendorInterface
{
    /**
     * @return string
     */
    public function getCode();

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
    public function getConsignmentOptions();

    /**
     * @return ArrayCollection
     */
    public function getParcelOptions();

    /**
     * @return ArrayCollection
     */
    public function getLabelPrintModes();

    /**
     * @return ArrayCollection
     */
    public function getDispatchConfirmationPrintModes();
}
