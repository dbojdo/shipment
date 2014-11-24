<?php
/**
 * File: EventConsignment.php
 * Created at: 2014-11-23 16:11
 */
 
namespace Webit\Shipment\Event;

use Symfony\Component\EventDispatcher\Event;
use Webit\Shipment\Consignment\ConsignmentInterface;

/**
 * Class EventConsignment
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class EventConsignment extends Event
{
    /**
     * @var ConsignmentInterface
     */
    private $consignment;

    public function __constructor(ConsignmentInterface $consignment)
    {
        $this->consignment = $consignment;
    }

    /**
     * @return ConsignmentInterface
     */
    public function getConsignment()
    {
        return $this->consignment;
    }
}
 