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
     * @return ArrayCollection
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
}
