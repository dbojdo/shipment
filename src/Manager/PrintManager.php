<?php
/**
 * File PrintManager.php
 * Created at: 2015-03-16 05-41
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Manager;

use Webit\Shipment\Consignment\ConsignmentInterface;
use Webit\Shipment\Consignment\DispatchConfirmationInterface;
use Webit\Shipment\Manager\Exception\VendorNotFoundException;

class PrintManager implements PrintManagerInterface
{

    /**
     * @var VendorAdapterProviderInterface
     */
    private $adapterProvider;

    /**
     * @param VendorAdapterProviderInterface $adapterProvider
     */
    public function __construct(VendorAdapterProviderInterface $adapterProvider)
    {
        $this->adapterProvider = $adapterProvider;
    }

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @return \SplFileInfo
     */
    public function getDispatchConfirmationReceipt(DispatchConfirmationInterface $dispatchConfirmation)
    {
        $vendor = $this->getVendor($dispatchConfirmation);
        if (! $vendor) {
            throw new VendorNotFoundException(
                sprintf('Can not find Vendor for DispatchConfirmation with number "%d"', $dispatchConfirmation->getNumber())
            );
        }

        $adapter = $this->adapterProvider->getVendorAdapter($vendor);
        $receipt = $adapter->getConsignmentDispatchConfirmationReceipt($dispatchConfirmation);

        return $receipt;
    }

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @return \SplFileInfo
     */
    public function getDispatchConfirmationLabels(DispatchConfirmationInterface $dispatchConfirmation)
    {
        $vendor = $this->getVendor($dispatchConfirmation);
        if (! $vendor) {
            throw new VendorNotFoundException(
                sprintf('Can not find Vendor for DispatchConfirmation with number "%d"', $dispatchConfirmation->getNumber())
            );
        }

        $adapter = $this->adapterProvider->getVendorAdapter($vendor);
        $labels = $adapter->getConsignmentDispatchConfirmationLabel($dispatchConfirmation);

        return $labels;
    }

    /**
     * @param ConsignmentInterface $consignment
     * @return \SplFileInfo
     */
    public function getConsignmentLabel(ConsignmentInterface $consignment)
    {
        $vendor = $consignment->getVendor();
        if (! $vendor) {
            throw new VendorNotFoundException(
                sprintf('Can not find Vendor for Consignment with ID "%d"', $consignment->getId())
            );
        }

        $adapter = $this->adapterProvider->getVendorAdapter($vendor);
        $labels = $adapter->getConsignmentLabel($consignment);

        return $labels;
    }

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @return \Webit\Shipment\Vendor\VendorInterface
     */
    private function getVendor(DispatchConfirmationInterface $dispatchConfirmation)
    {
        /** @var ConsignmentInterface $consignment */
        $consignment = $dispatchConfirmation->getConsignments()->first();

        return $consignment ? $consignment->getVendor() : null;
    }
}
