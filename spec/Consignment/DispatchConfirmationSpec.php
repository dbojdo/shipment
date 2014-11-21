<?php

namespace spec\Webit\Shipment\Consignment;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DispatchConfirmationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Webit\Shipment\Consignment\DispatchConfirmation');
    }

    function it_is_under_dispatch_confirmation_interface_contract()
    {
        $this->beAnInstanceOf('Webit\Shipment\Consignment\DispatchConfirmationInterface');
    }

    function it_is_aware_of_consignment()
    {
        $this->getConsignments()->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }

    function it_is_aware_of_number($number = 'Number')
    {
        $this->setNumber($number);
        $this->getNumber()->shouldReturn($number);
    }

    function it_is_aware_of_dispatch_date(\DateTime $date)
    {
        $this->setDispatchedAt($date);
        $this->getDispatchedAt()->shouldReturn($date);
    }
}
