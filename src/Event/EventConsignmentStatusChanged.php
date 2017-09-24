<?php

namespace Webit\Shipment\Event;

use Symfony\Component\EventDispatcher\Event;
use Webit\Shipment\Consignment\ConsignmentInterface;

class EventConsignmentStatusChanged extends Event
{
    /** @var ConsignmentInterface */
    private $consignment;

    /** @var string */
    private $previousStatus;

    /**
     * EventConsignmentStatusChanged constructor.
     * @param ConsignmentInterface $consignment
     * @param $previousStatus
     */
    public function __construct(ConsignmentInterface $consignment, $previousStatus)
    {
        $this->consignment = $consignment;
        $this->previousStatus = $previousStatus;
    }

    /**
     * @return ConsignmentInterface
     */
    public function consignment()
    {
        return $this->consignment;
    }

    /**
     * @return string
     */
    public function previousStatus()
    {
        return $this->previousStatus;
    }
}