<?php

namespace spec\Webit\Shipment\Parcel;

use PhpSpec\ObjectBehavior;
use PhpSpec\Wrapper\Collaborator;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Webit\Shipment\Vendor\VendorOptionInterface;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

class ParcelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Webit\Shipment\Parcel\Parcel');
    }

    function it_is_under_parcel_interface_contract()
    {
        $this->shouldHaveType('Webit\Shipment\Parcel\ParcelInterface');
    }

    function it_is_aware_of_weight()
    {
        $weight = 0.55;
        $this->setWeight($weight);
        $this->getWeight()->shouldReturn($weight);
    }

    function it_is_aware_of_reference()
    {
        $reference = 'Reference';
        $this->setReference($reference);
        $this->getReference()->shouldReturn($reference);
    }

    function it_is_aware_of_number()
    {
        $number = 'Parcel Number';
        $this->setNumber($number);
        $this->getNumber()->shouldReturn($number);
    }

    function it_is_aware_of_vendor_option_values()
    {
        $this->getVendorOptions()->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }

    function it_is_able_to_set_vendor_option_value(VendorOptionValueInterface $value, VendorOptionInterface $option)
    {
        $option->getCode()->willReturn('option-1');
        $value->getOption()->willReturn($option);

        $this->setVendorOption($value);
        $this->getVendorOption('option-1')->shouldReturn($value);

        $option->getCode()->willReturn(null);
        $this->shouldThrow('Webit\Shipment\Parcel\Exception\InvalidVendorOptionValueException')->during('setVendorOption', array($value));

        $value->getOption()->willReturn(null);
        $this->shouldThrow('Webit\Shipment\Parcel\Exception\InvalidVendorOptionValueException')->during('setVendorOption', array($value));
    }

    function it_is_should_replace_exiting_vendor_option_value(
        VendorOptionValueInterface $value,
        VendorOptionValueInterface $newValue,
        VendorOptionInterface $option
    ) {
        $option->getCode()->willReturn('option-1');

        $value->getOption()->willReturn($option);
        $newValue->getOption()->willReturn($option);

        $this->setVendorOption($value);
        $this->setVendorOption($newValue);

        $this->getVendorOption('option-1')->shouldReturn($newValue);
    }

    function it_is_able_to_unset_vendor_option_value(VendorOptionValueInterface $value, VendorOptionInterface $option)
    {
        $option->getCode()->willReturn('option-1');
        $value->getOption()->willReturn($option);

        $this->unsetVendorOption($value);
        $this->getVendorOption('option-1')->shouldReturn(null);
    }
}
