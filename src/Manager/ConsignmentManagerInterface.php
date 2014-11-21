<?php
/**
 * ConsignmentManagerInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:21
 */

namespace Webit\Shipment\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Consignment\ConsignmentDispatchConfirmationInterface;
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
     * Update given consignment
     * @param ConsignmentInterface $consignment
     */
    public function updateConsignment(ConsignmentInterface $consignment);

    /**
     * Remove given consignment. Allowed only in "new" status
     * @param ConsignmentInterface $consignment
     */
    public function removeConsignment(ConsignmentInterface $consignment);

    /**
     * Add parcel to given consignment. Allowed only in "new" status
     * @param ConsignmentInterface $consignment
     * @param ParcelInterface $parcel
     */
    public function addParcel(ConsignmentInterface $consignment, ParcelInterface $parcel);

    /**
     * Remove parcel from given consignment. Allowed only in "new" status
     * @param ConsignmentInterface $consignment
     * @param ParcelInterface $parcel
     */
    public function removeParcel(ConsignmentInterface $consignment, ParcelInterface $parcel);

    /**
     * Prepare single consignment. Change status from new -> prepared
     * @param ConsignmentInterface $consignment
     * @return ConsignmentDispatchConfirmationInterface
     */
    public function dispatchConsignment(ConsignmentInterface $consignment);

    /**
     * Prepare given consignments. Change status from new -> prepared
     * @param ArrayCollection $consignments
     * @return ConsignmentDispatchConfirmationInterface
     */
    public function dispatchConsignments(ArrayCollection $consignments);

    /**
     * Cancel given consignment. Allowed only in status different than "new".
     * @param ConsignmentInterface $consignment
     */
    public function cancelConsignment(ConsignmentInterface $consignment);
}
