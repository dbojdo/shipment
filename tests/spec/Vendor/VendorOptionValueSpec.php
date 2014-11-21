<?php

namespace spec\Webit\Shipment\Vendor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Webit\Shipment\Vendor\VendorOptionInterface;

class VendorOptionValueSpec extends ObjectBehavior
{
    /**
     * @var VendorOptionInterface
     */
    private $option;

    function let(VendorOptionInterface $option)
    {
        $this->option = $option;
        $this->beConstructedWith($option);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Webit\Shipment\Vendor\VendorOptionValue');
    }

    function it_is_under_vendor_option_value_interface()
    {
        $this->shouldHaveType('Webit\Shipment\Vendor\VendorOptionValueInterface');
    }

    function it_is_aware_of_option()
    {
        $this->getOption()->shouldReturn($this->option);
    }

    function it_is_aware_of_value($value = 'aaa')
    {
        $this->setValue($value);
        $this->getValue()->shouldReturn($value);
    }
}
