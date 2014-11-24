<?php
/**
 * File: EventDispatchConfirmation.php
 * Created at: 2014-11-23 16:16
 */
 
namespace Webit\Shipment\Event;

use Webit\Shipment\Consignment\DispatchConfirmationInterface;

/**
 * Class EventDispatchConfirmation
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class EventDispatchConfirmation
{
    /**
     * @var DispatchConfirmationInterface
     */
    private $dispatchConfirmation;

    public function __construct(DispatchConfirmationInterface $dispatchConfirmation)
    {
        $this->dispatchConfirmation = $dispatchConfirmation;
    }

    public function getDispatchConfirmation()
    {
        return $this->dispatchConfirmation;
    }
}
 