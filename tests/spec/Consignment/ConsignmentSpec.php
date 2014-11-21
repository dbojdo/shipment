<?php

namespace spec\Webit\Shipment\Consignment;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Webit\Shipment\Address\DeliveryAddressInterface;
use Webit\Shipment\Address\SenderAddressInterface;
use Webit\Shipment\Consignment\DispatchConfirmationInterface;
use Webit\Shipment\Parcel\ParcelInterface;
use Webit\Shipment\Vendor\VendorInterface;
use Webit\Shipment\Vendor\VendorOptionInterface;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

class ConsignmentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Webit\Shipment\Consignment\Consignment');
    }

    function it_is_under_consignment_interface_contract()
    {
        $this->shouldHaveType('Webit\Shipment\Consignment\ConsignmentInterface');
    }

    function it_is_aware_of_id()
    {
        $this->getId();
    }

    function it_is_aware_of_vendor(VendorInterface $vendor)
    {
        $this->setVendor($vendor);
        $this->getVendor()->shouldReturn($vendor);
    }

    function it_is_aware_of_vendor_id()
    {
        $this->setVendorId('vendor-id');
        $this->getVendorId()->shouldReturn('vendor-id');
    }

    function it_is_aware_of_vendor_status($status = 'status-1')
    {
        $this->setVendorStatus($status);
        $this->getVendorStatus()->shouldReturn($status);
    }

    function it_is_aware_of_status($status = 'status-1')
    {
        $this->setStatus($status);
        $this->getStatus()->shouldReturn($status);
    }

    function it_is_aware_of_reference($reference = 'reference-1')
    {
        $this->setReference($reference);
        $this->getReference()->shouldReturn($reference);
    }

    function it_is_aware_of_sender_address(SenderAddressInterface $address)
    {
        $this->setSenderAddress($address);
        $this->getSenderAddress()->shouldReturn($address);
    }

    function it_is_aware_of_delivery_address(DeliveryAddressInterface $address)
    {
        $this->setDeliveryAddress($address);
        $this->getDeliveryAddress()->shouldReturn($address);
    }

    function it_is_aware_of_parcels()
    {
        $this->getParcels()->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }

    function it_is_able_to_add_parcel(ParcelInterface $parcel)
    {
        $this->addParcel($parcel);
        $this->getParcels()->count()->shouldReturn(1);
    }

    function it_is_able_not_to_add_same_parcel_twice(ParcelInterface $parcel)
    {
        $this->addParcel($parcel);
        $this->addParcel($parcel);
        $this->getParcels()->count()->shouldReturn(1);
    }

    function it_is_able_to_remove_parcel(ParcelInterface $parcel)
    {
        $this->addParcel($parcel);
        $this->removeParcel($parcel);

        $this->getParcels()->count()->shouldReturn(0);
    }

    function it_is_aware_if_dispatch_confirmation(DispatchConfirmationInterface $dispatchConfirmation)
    {
        $this->setDispatchConfirmation($dispatchConfirmation);
        $this->getDispatchConfirmation()->shouldReturn($dispatchConfirmation);
    }

    function it_is_able_to_set_dispatch_confirmation_to_null()
    {
        $this->setDispatchConfirmation(null);
        $this->getDispatchConfirmation()->shouldReturn(null);
    }

    function it_is_aware_of_vendor_option_values()
    {
        $this->getVendorOptions()->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }


    function it_is_able_to_set_vendor_option(VendorOptionValueInterface $optionValue, VendorOptionInterface $option)
    {
        $optionValue->getOption()->willReturn($option);
        $option->getCode()->shouldBeCalled()->willReturn('option-1');

        $this->setVendorOption($optionValue);
        $this->getVendorOption('option-1')->shouldReturn($optionValue);
    }

    function it_is_able_to_replace_vendor_option(
        VendorOptionValueInterface $optionValue,
        VendorOptionValueInterface $optionValue2,
        VendorOptionInterface $option
    ) {
        $optionValue->getOption()->willReturn($option);
        $optionValue2->getOption()->willReturn($option);
        $option->getCode()->willReturn('option-1');

        $this->setVendorOption($optionValue);
        $this->setVendorOption($optionValue2);

        $this->getVendorOption('option-1')->shouldReturn($optionValue2);
    }

    function it_is_not_dealing_with_empty_options(
        VendorOptionValueInterface $optionValue,
        VendorOptionInterface $option
    ) {
        $this->shouldThrow('Webit\Shipment\Consignment\Exception\InvalidVendorOptionValueException')
          ->during('setVendorOption', array($optionValue));

        $this->shouldThrow('Webit\Shipment\Consignment\Exception\InvalidVendorOptionValueException')
          ->during('unsetVendorOption', array($optionValue));

        $optionValue->getOption()->willReturn($option);
        $this->shouldThrow('Webit\Shipment\Consignment\Exception\InvalidVendorOptionValueException')
            ->during('setVendorOption', array($optionValue));

        $this->shouldThrow('Webit\Shipment\Consignment\Exception\InvalidVendorOptionValueException')
            ->during('unsetVendorOption', array($optionValue));
    }

    function it_is_able_to_unset_vendor_option(VendorOptionValueInterface $optionValue, VendorOptionInterface $option)
    {
        $optionValue->getOption()->willReturn($option);
        $option->getCode()->shouldBeCalled()->willReturn('option-1');

        $this->setVendorOption($optionValue);
        $this->unsetVendorOption($optionValue);
        $this->getVendorOption('option-1')->shouldReturn(null);
    }

    function it_is_aware_of_weight(ParcelInterface $parcel1, ParcelInterface $parcel2)
    {
        // no parcels => 0
        $this->getWeight()->shouldReturn(0);

        $parcel1->getWeight()->willReturn(10.25);
        $parcel2->getWeight()->willReturn(0.75);

        $this->addParcel($parcel1);
        $this->addParcel($parcel2);

        $this->getWeight()->shouldReturn(11.);
    }
}
