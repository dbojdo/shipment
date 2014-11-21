<?php

namespace spec\Webit\Shipment\Vendor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

class VendorOptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Webit\Shipment\Vendor\VendorOption');
    }

    function it_is_under_vendor_option_interface_contract()
    {
        $this->shouldHaveType('Webit\Shipment\Vendor\VendorOptionInterface');
    }

    function it_is_aware_of_code($code = 'code-1')
    {
        $this->setCode($code);
        $this->getCode()->shouldReturn($code);
    }

    function it_is_aware_of_name($name = 'name-1')
    {
        $this->setName($name);
        $this->getName()->shouldReturn($name);
    }

    function it_is_aware_of_description($desc)
    {
        $this->setDescription($desc);
        $this->getDescription()->shouldReturn($desc);
    }

    function it_is_aware_of_allowed_values()
    {
        $this->getAllowedValues()->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }

    function it_is_able_to_add_allowed_value($value = 'aaa')
    {
        $this->addAllowedValue($value);
        $this->getAllowedValues()->count()->shouldReturn(1);
    }

    function it_is_able_to_remove_allowed_value($value = 'aaa')
    {
        $this->addAllowedValue($value);
        $this->removeAllowedValue($value);
        $this->getAllowedValues()->count()->shouldReturn(0);
    }

    function it_is_able_to_check_if_value_is_allowed($value = 'aaa')
    {
        $this->isAllowedValue('aaaa')->shouldReturn(true);

        $this->addAllowedValue($value);
        $this->isAllowedValue($value)->shouldReturn(true);
        $this->isAllowedValue('other-value')->shouldReturn(false);
    }
}
