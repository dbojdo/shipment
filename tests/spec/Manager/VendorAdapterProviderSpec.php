<?php

namespace spec\Webit\Shipment\Manager;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Webit\Shipment\Manager\VendorAdapterInterface;
use Webit\Shipment\Vendor\VendorInterface;

class VendorAdapterProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Webit\Shipment\Manager\VendorAdapterProvider');
    }

    function it_is_under_vendor_adapter_provider_interface_contract()
    {
        $this->shouldHaveType('Webit\Shipment\Manager\VendorAdapterProviderInterface');
    }

    function it_is_able_to_register_adapter(VendorAdapterInterface $vendorAdapter)
    {
        $vendorAdapter->getVendorCode()->shouldBeCalled()->willReturn('vendor-1');
        $this->registerVendorAdapter($vendorAdapter);
    }

    function it_is_able_to_prevent_register_same_vendor_twice(VendorAdapterInterface $vendorAdapter)
    {
        $vendorAdapter->getVendorCode()->willReturn('vendor-1');
        $this->registerVendorAdapter($vendorAdapter);

        $this->shouldThrow('\Webit\Shipment\Manager\Exception\VendorAdapterAlreadyRegisteredException')
                ->during('registerVendorAdapter', array($vendorAdapter));
    }

    function it_is_able_to_get_adapter_for_vendor(VendorInterface $vendor, VendorAdapterInterface $vendorAdapter)
    {
        $vendorAdapter->getVendorCode()->willReturn('vendor-1');
        $vendor->getCode()->shouldBeCalled()->willReturn('vendor-1');

        $this->registerVendorAdapter($vendorAdapter);
        $this->getVendorAdapter($vendor)->shouldReturn($vendorAdapter);
    }

}
