<?php
/**
 * File VendorOptionCollectionNormaliserTest.php
 * Created at: 2016-03-20 21-52
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Tests\Serializer;

use Webit\Shipment\Serializer\VendorOptionCollectionNormaliser;
use Webit\Shipment\Vendor\VendorOption;
use Webit\Shipment\Vendor\VendorOptionCollection;

class VendorOptionCollectionNormaliserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VendorOptionCollectionNormaliser
     */
    private $normaliser;

    protected function setUp()
    {
        $this->normaliser = new VendorOptionCollectionNormaliser();
    }

    /**
     * @param $collection
     * @param $normalised
     * @test
     * @dataProvider data
     */
    public function shouldNormliseVendorOptionCollection($collection, $normalised)
    {
        $this->assertEquals($normalised, $this->normaliser->normalise($collection));
    }

    /**
     * @param $collection
     * @param $normalised
     * @test
     * @dataProvider data
     */
    public function shouldDenormaliseVendorOptionCollection($collection, $normalised)
    {
        $this->assertEquals($collection, $this->normaliser->denormalise($normalised));
    }

    public function data()
    {
        $collection = new VendorOptionCollection();

        $option1 = new VendorOption();
        $option1->setCode('code1');
        $option1->setName('Code #1');
        $option1->setDescription('Code #1 Description');
        $option1->addAllowedValue('val11');
        $option1->addAllowedValue('val12');

        $collection->addOption($option1);

        $option2 = new VendorOption();
        $option2->setCode('code2');
        $option2->setName('Code #2');
        $option2->setDescription('Code #2 Description');
        $option2->addAllowedValue('val21');
        $option2->addAllowedValue('val22');

        $collection->addOption($option2);

        $normalised = array(
            'code1' => array(
                'code' => 'code1',
                'name' => 'Code #1',
                'description' => 'Code #1 Description',
                'allowed_values' => array('val11', 'val12')
            ),
            'code2' => array(
                'code' => 'code2',
                'name' => 'Code #2',
                'description' => 'Code #2 Description',
                'allowed_values' => array('val21', 'val22')
            )
        );

        return array(
            array($collection, $normalised)
        );
    }
}
