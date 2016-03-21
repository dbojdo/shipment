<?php
/**
 * File VendorOptionValueCollectionTypeTest.php
 * Created at: 2016-03-21 10-12
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Tests\DBAL;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Webit\Shipment\DBAL\VendorOptionValueCollectionType;
use Webit\Shipment\Serializer\VendorOptionValueCollectionNormaliser;
use Webit\Shipment\Vendor\VendorOptionValue;
use Webit\Shipment\Vendor\VendorOptionValueCollection;

class VendorOptionValueCollectionTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VendorOptionValueCollectionType
     */
    private $type;

    /**
     * @var AbstractPlatform
     */
    private $platform;

    protected function setUp()
    {
        try {
            Type::addType(VendorOptionValueCollectionType::TYPE_NAME, VendorOptionValueCollectionType::class);
        } catch (DBALException $e) {
        }

        $this->type = Type::getType(VendorOptionValueCollectionType::TYPE_NAME);
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
        $this->assertEquals(VendorOptionValueCollectionType::TYPE_NAME, $this->type->getName());
    }

    public function data()
    {
        $normaliser = new VendorOptionValueCollectionNormaliser();

        $collection = new VendorOptionValueCollection();

        $value1 = new VendorOptionValue('opt1');
        $value1->setValue('val1');
        $collection->addValue($value1);

        $value2 = new VendorOptionValue('opt2');
        $value2->setValue(array('val1', 'val2'));

        $collection->addValue($value2);

        return array(
            array($collection, $normaliser->normalise($collection)),
            array(null, null)
        );
    }
}
