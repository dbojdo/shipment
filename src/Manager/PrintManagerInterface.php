<?php
/**
 * File PrintManagerInterface.php
 * Created at: 2015-03-16 05-39
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Manager;


use Webit\Shipment\Consignment\ConsignmentInterface;
use Webit\Shipment\Consignment\DispatchConfirmationInterface;

interface PrintManagerInterface
{
    public function getDispatchConfirmationReceipt(DispatchConfirmationInterface $dispatchConfirmation);

    public function getDispatchConfirmationLabels(DispatchConfirmationInterface $dispatchConfirmationInterface);

    /**
     * @param ConsignmentInterface $consignment
     * @return mixed
     */
    public function getConsignmentLabel(ConsignmentInterface $consignment);
}