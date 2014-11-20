<?php
/**
 * ConsignmentRepositoryInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:12
 */

namespace Webit\Shipment\Consignment;

/**
 * Interface ConsignmentRepositoryInterface
 * @package Webit\Shipment\Consignment
 */
interface ConsignmentRepositoryInterface
{
    /**
     * @param mixed $id
     * @return ConsignmentInterface
     */
    public function getConsignment($id);
}
