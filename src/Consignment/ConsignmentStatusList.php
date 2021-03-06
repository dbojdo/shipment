<?php
/**
 * ConsignmentStatusList.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:15
 */

namespace Webit\Shipment\Consignment;

use Webit\Shipment\Consignment\Exception\InvalidConsignmentStatusException;

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
        return array(
            self::STATUS_NEW,
            self::STATUS_DISPATCHED,
            self::STATUS_COLLECTED,
            self::STATUS_DELIVERED,
            self::STATUS_CLOSED,
            self::STATUS_CANCELED,
            self::STATUS_CONCERNED
        );
    }

    /**
     * @return string[]
     */
    public static function openedStatuses()
    {
        return array(
            self::STATUS_DISPATCHED,
            self::STATUS_COLLECTED,
            self::STATUS_CONCERNED
        );
    }

    public static function assertStatus($status)
    {
        if ($status && !in_array(self::normaliseStatus($status), self::getStatusList())) {
            throw InvalidConsignmentStatusException::createForStatus($status);
        }
    }

    public static function normaliseStatus($status)
    {
        return strtolower(trim($status)) ?: null;
    }
}
