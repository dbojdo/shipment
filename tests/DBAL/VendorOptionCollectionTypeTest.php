<?php
/**
 * File VendorOptionCollectionTypeTest.php
 * Created at: 2016-03-21 09-51
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Tests\DBAL;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Webit\Shipment\DBAL\VendorOptionCollectionType;
use Webit\Shipment\Serializer\VendorOptionCollectionNormaliser;
use Webit\Shipment\Vendor\VendorOption;
use Webit\Shipment\Vendor\VendorOptionCollection;

class VendorOptionCollectionTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VendorOptionCollectionType
     */
    private $type;

    /**
     * @var AbstractPlatform
     */
    private $platform;

    protected function setUp()
    {
        try {
            Type::addType(VendorOptionCollectionType::TYPE_NAME, VendorOptionCollectionType::class);
        } catch (DBALException $e) {
        }

        $this->type = Type::getType(VendorOptionCollectionType::TYPE_NAME);
        $this->platform = $this->getMockForAbstractClass(AbstractPlatform::class);
    }

    /**
     * @test
     * @dataProvider data
     */
    public function shouldConvertToDatabaseValue($collection, $normalised)
    {
        $value = $this->type->convertToDatabaseValue(
            $collection,
            $this->platform
        );

        $expected = $collection ? json_encode($normalised) : null;

        $this->assertEquals($expected, $value);
    }

    /**
     * @test
     * @dataProvider data
     */
    public function shouldConvertToPHPValue($collection, $normalised)
    {
        $value = $this->type->convertToPHPValue(
            json_encode($normalised),
            $this->platform
        );

        $this->assertEquals($collection, $value);
    }

    /**
     * @test
     */
    public function shouldReturnTypeName()
    {
        $this->assertEquals(VendorOptionCollectionType::TYPE_NAME, $this->type->getName());
    }

    public function data()
    {
        $normaliser = new VendorOptionCollectionNormaliser();

        $collection = new VendorOptionCollection();

        $option1 = new VendorOption();
        $option1->setName('opt1');
        $option1->addAllowedValue('val11');
        $option1->addAllowedValue('val12');

        $collection->addOption($option1);

        $option2 = new VendorOption();
        $option2->setName('opt2');
        $option2->addAllowedValue('val21');
        $option2->addAllowedValue('val22');
        $collection->addOption($option2);

        return array(
            array($collection, $normaliser->normalise($collection)),
            array(null, null)
        );
    }
}
