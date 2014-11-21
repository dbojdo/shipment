<?php

namespace spec\Webit\Shipment\Vendor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Webit\Shipment\Vendor\VendorInterface;

class VendorRepositoryInMemorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Webit\Shipment\Vendor\VendorRepositoryInMemory');
    }

    function it_is_under_repository_interface_contract()
    {
        $this->beAnInstanceOf('Webit\Shipment\Vendor\VendorRepositoryInterface');
    }

    function it_is_able_to_return_vendors_collection()
    {
        $this->getVendors()->shouldHaveType('Doctrine\Common\Collections\ArrayCollection');
    }

    function it_is_able_to_add_vendor(VendorInterface $vendor)
    {
        $vendor->getCode()->willReturn('vendor-1');
        $this->addVendor($vendor);
    }

    function it_is_able_to_prevent_add_the_same_vendor_twice(VendorInterface $vendor, VendorInterface $vendor2)
    {
        $vendor->getCode()->willReturn('vendor-1');
        $vendor2->getCode()->willReturn('vendor-1');

        $this->addVendor($vendor);
        $this->shouldThrow('Webit\Shipment\Vendor\Exception\VendorAlreadyExistsException')
                ->during('addVendor', array($vendor2));
    }

    function it_is_able_to_return_vendor_by_code(VendorInterface $vendor)
    {
        $vendor->getCode()->willReturn('vendor-1');
        $this->addVendor($vendor);

        $this->getVendor('vendor-1')->shouldReturn($vendor);
        $this->getVendor('non-existent')->shouldReturn(null);
    }

    function it_is_able_to_remove_vendor(VendorInterface $vendor)
    {
        $vendor->getCode()->willReturn('vendor-1');

        $this->addVendor($vendor);
        $this->getVendor('vendor-1')->shouldReturn($vendor);

        $this->removeVendor($vendor);
        $this->getVendor('vendor-1')->shouldReturn(null);
    }
}
