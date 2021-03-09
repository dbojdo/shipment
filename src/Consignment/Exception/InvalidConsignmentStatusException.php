<?php

namespace Webit\Shipment\Consignment\Exception;

use Webit\Shipment\Consignment\ConsignmentStatusList;

final class InvalidConsignmentStatusException extends \OutOfBoundsException
{
    public function __construct($status)
    {
        parent::__construct(
            sprintf(
                'Consignment status must be one of "%s" but "%s" given.',
                implode('", "', ConsignmentStatusList::getStatusList()),
                $status
            )
        );
    }

    public static function createForStatus($status)
    {
        return new self($status);
    }
}