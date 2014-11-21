<?php
/**
 * File: VendorAdapterProviderTest.php
 * Created at: 2014-11-21 06:45
 */
 
namespace Webit\Shipment\Tests\Manager;

use Webit\Shipment\Manager\VendorAdapterInterface;
use Webit\Shipment\Manager\VendorAdapterProvider;
use Webit\Shipment\Vendor\VendorInterface;


/**
 * Class VendorAdapterProviderTest
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class VendorAdapterProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VendorAdapterProvider
     */
    private $vendorAdapterProvider;

    public function setUp()
    {
        $this->vendorAdapterProvider = new VendorAdapterProvider();
    }


    /**
     * @test
     */
    public function shouldBeAbleToRegisterAdapter()
    {
        $this->vendorAdapterProvider->registerVendorAdapter($this->createVendorAdapter('aaa'));
    }

    /**
     * @test
     * @expectedException \Webit\Shipment\Manager\Exception\VendorAdapterAlreadyRegisteredException
     */
    public function shouldNotAllowedRegisterAdaptersForTheSameVendor()
    {
        $this->vendorAdapterProvider->registerVendorAdapter($this->createVendorAdapter('aaa'));
        $this->vendorAdapterProvider->registerVendorAdapter($this->createVendorAdapter('aaa'));
    }

    /**
     * @test
     */
    public function shouldReturnAdapterForGivenVendor()
    {
        $this->vendorAdapterProvider->registerVendorAdapter($this->createVendorAdapter('aaa'));
        $this->vendorAdapterProvider->getVendorAdapter($this->createVendor('aaa'));
    }

    /**
     * @param string $code
     * @return \PHPUnit_Framework_MockObject_MockObject|VendorAdapterInterface
     */
    private function createVendorAdapter($code)
    {
        $vendorAdapter = $this->getMock('Webit\Shipment\Manager\VendorAdapterInterface');
        $vendorAdapter->expects($this->any())->method('getVendorCode')->willReturn($code);

        return $vendorAdapter;
    }

    /**
     * @param string $code
     * @return \PHPUnit_Framework_MockObject_MockObject|VendorInterface
     */
    private function createVendor($code)
    {
        $vendor = $this->getMock('Webit\Shipment\Vendor\VendorInterface');
        $vendor->expects($this->any())->method('getCode')->willReturn($code);

        return $vendor;
    }
}
 