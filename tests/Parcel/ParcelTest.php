<?php
/**
 * File: ParcelTest.php
 * Created at: 2014-11-21 07:13
 */
 
namespace Webit\Shipment\Tests\Parcel;

use Webit\Shipment\Parcel\Parcel;
use Webit\Shipment\Vendor\VendorOptionInterface;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

/**
 * Class ParcelTest
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class ParcelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parcel
     */
    private $parcel;

    public function setUp()
    {
        $this->parcel = new Parcel();
    }

    /**
     * @test
     */
    public function shouldBeAwareOfNumber()
    {
        $number = 'Parcel No';
        $this->parcel->setNumber($number);
        $this->assertEquals($number, $this->parcel->getNumber());
    }

    /**
     * @test
     */
    public function shouldBeAwareOfWeight()
    {
        $weight = 0.55;
        $this->parcel->setWeight($weight);
        $this->assertEquals($weight, $this->parcel->getWeight());
    }

    /**
     * @test
     */
    public function shouldBeAwareOfReference()
    {
        $reference = 'Reference';
        $this->parcel->setReference($reference);
        $this->assertEquals($reference, $this->parcel->getReference());
    }

    /**
     * @test
     */
    public function shouldBeAwareOfVendorOptions()
    {
        $vendorOptions = $this->parcel->getVendorOptions();
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $vendorOptions);

        $option = $this->createVendorOptionValue('option-1');
        $this->parcel->setVendorOption($option);
        $this->assertSame($option, $this->parcel->getVendorOption('option-1'));
    }

    /**
     * @test
     */
    public function shouldReplaceVendorOption()
    {
        $option = $this->createVendorOptionValue('option-1');
        $optionDuplicate = $this->createVendorOptionValue('option-1');
        $this->parcel->setVendorOption($option);
        $this->parcel->setVendorOption($optionDuplicate);

        $this->assertSame($optionDuplicate, $this->parcel->getVendorOption('option-1'));
        $this->assertNotSame($option, $this->parcel->getVendorOption('option-1'));
    }

    /**
     * @test
     * @expectedException \Webit\Shipment\Parcel\Exception\InvalidVendorOptionValueException
     */
    public function shouldNotAllowAddVendorOptionValueWithoutVendorOption()
    {
        $option = $this->createVendorOptionValue();
        $this->parcel->setVendorOption($option);
    }

    /**
     * @test
     * @expectedException \Webit\Shipment\Parcel\Exception\InvalidVendorOptionValueException
     */
    public function shouldNotAllowAddVendorOptionValueWithEmptyVendorOptionCode()
    {
        $option = $this->createVendorOptionValue('');
        $this->parcel->setVendorOption($option);
    }

    /**
     * @test
     */
    public function shouldBeAbleToUnsetVendorOption()
    {
        $option = $this->createVendorOptionValue('option-1');
        $this->parcel->setVendorOption($option);
        $this->parcel->unsetVendorOption($option);

        $this->assertNull($this->parcel->getVendorOption('option-1'));
    }

    /**
     * @param string $code
     * @return \PHPUnit_Framework_MockObject_MockObject|VendorOptionValueInterface
     */
    private function createVendorOptionValue($code = '')
    {
        $optionValue = $this->getMock('Webit\Shipment\Vendor\VendorOptionValueInterface');

        if ($code !== null) {
            $optionValue->expects($this->any())->method('getOption')->willReturn($this->createOption($code));
        }

        return $optionValue;
    }

    /**
     * @param string $code
     * @return \PHPUnit_Framework_MockObject_MockObject|VendorOptionInterface
     */
    private function createOption($code)
    {
        $option = $this->getMock('Webit\Shipment\Vendor\VendorOptionInterface');
        $option->expects($this->any())->method('getCode')->willReturn($code);

        return $option;
    }
}
