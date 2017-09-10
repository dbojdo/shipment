<?php
/**
 * DispatchConfirmationInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 16:07
 */

namespace Webit\Shipment\Consignment;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DispatchConfirmationInterface
 * @package Webit\Shipment\Consignment
 */
interface DispatchConfirmationInterface
{
    /**
     * @return string
     */
    public function getNumber();

    /**
     * @param string $number
     */
    public function setNumber($number);

    /**
     * @return ArrayCollection|ConsignmentInterface[]
     */
    public function getConsignments();

    /**
     * @return \DateTime
     */
    public function getDispatchedAt();

    /**
     * @param \DateTime $dispatchedAt
     */
    public function setDispatchedAt(\DateTime $dispatchedAt);

    /**
     * @return \DateTime
     */
    public function getPickUpAt();

    /**
     * @param \DateTime $pickUpAt
     */
    public function setPickUpAt(\DateTime $pickUpAt);

    /**
     * @return bool
     */
    public function isCourierCalled();

    /**
     * @param bool $courierCalled
     */
    public function setCourierCalled($courierCalled);

    /**
     * @return array
     */
    public function getVendorData();

    /**
     * @param array $data
     */
    public function setVendorData(array $data);

    /**
     * @param string $key
     * @param mixed $data
     */
    public function addVendorData($key, $data);
}
