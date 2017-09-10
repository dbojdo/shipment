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
     * @param VendorOptionValueCollection $collection
     * @param array $normalised
     */
    public function shouldNormaliseVendorOptionValueCollection(
        VendorOptionValueCollection $collection,
        array $normalised
    ) {
        $this->assertEquals($normalised, $this->normaliser->normalise($collection));
    }

    /**
     * @param VendorOptionValueCollection $collection
     * @param array $normalised
     * @test
     * @dataProvider data
     */
    public function shouldDenormaliseVendorOptionValueCollection(
        VendorOptionValueCollection $collection,
        array $normalised
    ) {
        $this->assertEquals($collection, $this->normaliser->denormalise($normalised));
    }

    public function data()
    {
        return array(
            array(
                new VendorOptionValueCollection(
                    array(
                        $v1 = $this->optionValue('code1', 'value1'),
                        $v2 = $this->optionValue('code2', 'value2')
                    )
                ),
                array(
                    array('option_code' => $v1->getOptionCode(), 'value' => $v1->getValue()),
                    array('option_code' => $v2->getOptionCode(), 'value' => $v2->getValue())
                )
            )
        );
    }

    private function optionValue($code, $value)
    {
        $optionValue = new VendorOptionValue($code);
        $optionValue->setValue($value);

        return $optionValue;
    }
}
