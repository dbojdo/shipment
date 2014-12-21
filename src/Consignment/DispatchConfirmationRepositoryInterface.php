<?php
/**
 * File: DispatchConfirmationRepositoryInterface.php
 * Created at: 2014-12-01 04:05
 */
 
namespace Webit\Shipment\Consignment;

use Webit\Shipment\Vendor\VendorInterface;

/**
 * Class DispatchConfirmationRepositoryInterface
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
interface DispatchConfirmationRepositoryInterface
{

    /**
     * @return DispatchConfirmationInterface
     */
    public function createDispatchConfirmation();

    /**
     * @param VendorInterface $vendor
     * @param string $number
     * @return DispatchConfirmationInterface
     */
    public function getDispatchConfirmation(VendorInterface $vendor, $number);

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     */
    public function updateDispatchConfirmation(DispatchConfirmationInterface $dispatchConfirmation);

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     */
    public function removeDispatchConfirmation(DispatchConfirmationInterface $dispatchConfirmation);
}
