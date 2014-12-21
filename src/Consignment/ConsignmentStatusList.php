<?php
/**
 * ConsignmentStatusList.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:15
 */

namespace Webit\Shipment\Consignment;

/**
 * Class ConsignmentStatusList
 * @package Webit\Shipment\Consignment
 */
final class ConsignmentStatusList
{
    const STATUS_NEW = 'new';
    const STATUS_DISPATCHED = 'dispatched';
    const STATUS_COLLECTED = 'collected';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CLOSED = 'closed';
    const STATUS_CANCELED = 'canceled';
    const STATUS_CONCERNED = 'concerned';

    /**
     * @return array
     */
    public static function getStatusList()
    {
        $refCls = new \ReflectionClass(self);

        return array_values($refCls->getConstants());
    }
}
