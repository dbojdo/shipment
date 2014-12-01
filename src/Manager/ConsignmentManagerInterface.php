<?php
/**
 * ConsignmentManagerInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:21
 */

namespace Webit\Shipment\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Consignment\DispatchConfirmationInterface;
use Webit\Shipment\Consignment\ConsignmentInterface;
use Webit\Shipment\Parcel\ParcelInterface;
use Webit\Shipment\Vendor\VendorInterface;

/**
 * Interface ConsignmentManagerInterface
 * @package Webit\Shipment\Manager
 */
interface ConsignmentManagerInterface
{

    /**
     * @param ConsignmentInterface $consignment
     */
    public function synchronizeConsignment(ConsignmentInterface $consignment);

    /**
     * Save given consignment
     * @param ConsignmentInterface $consignment
     */
    public function saveConsignment(ConsignmentInterface $consignment);

    /**
     * @param ArrayCollection $consignments
     */
    public function synchronizeConsignmentsStatus(ArrayCollection $consignments);

    /**
     * Remove given consignment. Allowed only in "new" status
     * @param ConsignmentInterface $consignment
     */
    public function removeConsignment(ConsignmentInterface $consignment);

    /**
     * Prepare given consignments. Change status from new -> prepared
     * @param ArrayCollection $consignments
     * @return DispatchConfirmationInterface
     */
    public function dispatchConsignments(ArrayCollection $consignments);

    /**
     * Cancel given consignment. Allowed only in status different than "new".
     * @param ConsignmentInterface $consignment
     */
    public function cancelConsignment(ConsignmentInterface $consignment);
}
