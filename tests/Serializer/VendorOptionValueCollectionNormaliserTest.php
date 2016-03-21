<?php
/**
 * File VendorOptionValueCollectionNormaliserTest.php
 * Created at: 2016-03-20 22-01
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Tests\Serializer;

use Webit\Shipment\Serializer\VendorOptionValueCollectionNormaliser;
use Webit\Shipment\Vendor\VendorOptionValue;
use Webit\Shipment\Vendor\VendorOptionValueCollection;

class VendorOptionValueCollectionNormaliserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VendorOptionValueCollectionNormaliser
     */
    private $normaliser;

    protected function setUp()
    {
        $this->normaliser = new VendorOptionValueCollectionNormaliser();
    }

    /**
     * @test
     * @dataProvider data
     */
    public function shouldNormaliseVendorOptionValueCollection(VendorOptionValueCollection $collection, array $normalised)
    {
        $this->assertEquals($normalised, $this->normaliser->normalise($collection));
    }

    /**
     * @param VendorOptionValueCollection $collection
     * @param array $normalised
     * @test
     * @dataProvider data
     */
    public function shouldDenormaliseVendorOptionValueCollection(VendorOptionValueCollection $collection, array $normalised)
    {
        $this->assertEquals($collection, $this->normaliser->denormalise($normalised));
    }

    public function data()
    {
        $collection = new VendorOptionValueCollection();

        $optionValue1 = new VendorOptionValue('code1');
            $optionValue1->setValue('value1');

        $collection->addValue($optionValue1);

        $optionValue2 = new VendorOptionValue('code2');
            $optionValue2->setValue('value2');

        $collection->addValue($optionValue2);

        $normalised = array(
            'code1' => 'value1',
            'code2' => 'value2'
        );

        return array(
            array($collection, $normalised)
        );
    }
}
