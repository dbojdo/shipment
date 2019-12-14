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
use Webit\Shipment\Vendor\VendorInterface;

class PrintManager implements PrintManagerInterface
{
    /**
     * @var VendorAdapterProviderInterface
     */
    private $adapterProvider;

    /**
     * @var string
     */
    private $directory;

    /**
     * @param VendorAdapterProviderInterface $adapterProvider
     * @param null $directory
     */
    public function __construct(VendorAdapterProviderInterface $adapterProvider, $directory = null)
    {
        $this->adapterProvider = $adapterProvider;
        $this->directory = $directory ?: sys_get_temp_dir();
    }

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @return \SplFileInfo
     */
    public function getDispatchConfirmationReceipt(DispatchConfirmationInterface $dispatchConfirmation)
    {
        $adapter = $this->getVendorAdapterFromDispatchConfirmation($dispatchConfirmation);
        $receipt = $adapter->getConsignmentDispatchConfirmationReceipt($dispatchConfirmation);

        return $this->dump($receipt, 'receipt');
    }

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @return \SplFileInfo
     */
    public function getDispatchConfirmationLabels(DispatchConfirmationInterface $dispatchConfirmation)
    {
        $adapter = $this->getVendorAdapterFromDispatchConfirmation($dispatchConfirmation);
        $labels = $adapter->getConsignmentDispatchConfirmationLabel($dispatchConfirmation);

        return $this->dump($labels, 'labels');
    }

    /**
     * @param ConsignmentInterface $consignment
     * @return \SplFileInfo
     */
    public function getConsignmentLabel(ConsignmentInterface $consignment)
    {
        $adapter = $this->vendorAdapter($consignment->getVendor());

        $labels = $adapter->getConsignmentLabel($consignment);

        return $this->dump($labels, 'labels');
    }

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     * @return VendorAdapterInterface
     */
    private function getVendorAdapterFromDispatchConfirmation(DispatchConfirmationInterface $dispatchConfirmation)
    {
        /** @var ConsignmentInterface $consignment */
        $consignment = $dispatchConfirmation->getConsignments()->first();

        if (!($consignment && $consignment->getVendor())) {
            throw new VendorNotFoundException(
                sprintf(
                    'Can not find Vendor for DispatchConfirmation with number "%d"',
                    $dispatchConfirmation->getNumber()
                )
            );
        }

        return $this->vendorAdapter($consignment->getVendor());
    }

    /**
     * @param string $vendorCode
     * @return VendorAdapterInterface
     */
    private function vendorAdapter($vendorCode)
    {
        return $this->adapterProvider->getVendorAdapter($vendorCode);
    }

    /**
     * @param string $data
     * @param string $type
     * @return \SplFileInfo
     */
    private function dump($data, $type)
    {
        $result = @file_put_contents($file = tempnam($this->directory, $type . '_'), $data);

        return new \SplFileInfo($file);
    }
}
