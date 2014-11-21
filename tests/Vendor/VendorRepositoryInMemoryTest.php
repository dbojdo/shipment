<?php
/**
 * File: VendorRepositoryInMemoryTest.php
 * Created at: 2014-11-21 06:27
 */
 
namespace Webit\Shipment\Tests\Vendor;

use Webit\Shipment\Vendor\VendorInterface;
use Webit\Shipment\Vendor\VendorRepositoryInMemory;

/**
 * Class VendorRepositoryInMemoryTest
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class VendorRepositoryInMemoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VendorRepositoryInMemory
     */
    private $vendorRepository;

    public function setUp()
    {
        $this->vendorRepository = new VendorRepositoryInMemory();
            $this->vendorRepository->addVendor($this->createVendor('aaa'));
            $this->vendorRepository->addVendor($this->createVendor('bbb'));
            $this->vendorRepository->addVendor($this->createVendor('ccc'));
    }

    /**
     * @test
     */
    public function shouldBeAbleToAddVendor()
    {
        $vendor = $this->createVendor('ddd');
        $this->vendorRepository->addVendor($vendor);

        $this->assertSame($vendor, $this->vendorRepository->getVendor('ddd'));
    }

    /**
     * @test
     * @expectedException \Webit\Shipment\Vendor\Exception\VendorAlreadyExistsException
     */
    public function shouldNotAcceptVendorsWithSameCode()
    {
        $vendor = $this->createVendor('aaa');
        $this->vendorRepository->addVendor($vendor);
    }

    /**
     * @test
     */
    public function shouldBeAbleToRemoveVendor()
    {
        $exists = $this->vendorRepository->getVendor('aaa');
        $this->assertNotNull($exists);

        $this->vendorRepository->removeVendor($exists);

        $notExists = $this->vendorRepository->getVendor('aaa');
        $this->assertNull($notExists);
    }

    /**
     * @test
     */
    public function shouldBeAbleToFetchVendor()
    {
        $vendor = $this->vendorRepository->getVendor('aaa');
        $this->assertEquals('aaa', $vendor->getCode());
    }

    /**
     * @test
     */
    public function shouldBeAbleToReturnAllVendors()
    {
        $vendors = $this->vendorRepository->getVendors();
        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $vendors);
        $this->assertEquals(3, $vendors->count());
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
