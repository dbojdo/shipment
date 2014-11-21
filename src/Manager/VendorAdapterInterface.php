<?php
/**
 * VendorAdapterInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:38
 */

namespace Webit\Shipment\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Consignment\DispatchConfirmationInterface;
use Webit\Shipment\Consignment\ConsignmentInterface;
use Webit\Shipment\Vendor\VendorFactoryInterface;
use Webit\Shipment\Vendor\VendorInterface;
use Webit\Tools\Data\FilterCollection;
use Webit\Tools\Data\SorterCollection;

/**
 * Interface VendorAdapterInterface
 * @package Webit\Shipment\Manager
 */
interface VendorAdapterInterface extends VendorFactoryInterface
{
    /**
     * @return string
     */
    public function getVendorCode();

    /**
     * Returns consignments
     * @param FilterCollection $filters
     * @param SorterCollection $sorters
     * @param int $limit
     * @param int $offset
     * @return ArrayCollection
     */
    public function getConsignments(
        FilterCollection $filters = null,
        SorterCollection $sorters = null,
        $limit = 50,
        $offset = 0
    );

    /**
     * @param ArrayCollection $consignments
     * @return DispatchConfirmationInterface
     */
    public function dispatchConsignments(ArrayCollection $consignments);

    /**
     * Update consignment data with vendor's one
     * @param ConsignmentInterface $consignment
     * @return mixed
     */
    public function synchronizeConsignment(ConsignmentInterface $consignment);

    /**
     * Save consignment to vendor
     * @param ConsignmentInterface $consignment
     */
    public function saveConsignment(ConsignmentInterface $consignment);

    /**
     * Remove consignment from vendor
     * @param ConsignmentInterface $consignment
     */
    public function removeConsignment(ConsignmentInterface $consignment);

    /**
     * @param ConsignmentInterface $consignment
     * @param string $mode
     * @return \SplFileInfo
     */
    public function getConsignmentLabel(ConsignmentInterface $consignment, $mode = null);

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @param string $mode
     * @return \SplFileInfo
     */
    public function getConsignmentDispatchConfirmationLabel(
        DispatchConfirmationInterface $dispatchConfirmation,
        $mode = null
    );

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @param string $mode
     * @return \SplFileInfo
     */
    public function getConsignmentDispatchConfirmationReceipt(
        DispatchConfirmationInterface $dispatchConfirmation,
        $mode = null
    );

    /**
     * @param ConsignmentInterface $consignment
     * @return string
     */
    public function getConsignmentsStatus(ConsignmentInterface $consignment);

    /**
     * @param ConsignmentInterface $consignment
     * @return string
     */
    public function getConsignmentTrackingUrl(ConsignmentInterface $consignment);
}
