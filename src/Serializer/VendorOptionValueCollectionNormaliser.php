<?php
/**
 * File VendorOptionValueCollectionNormaliser.php
 * Created at: 2016-03-20 20-59
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Serializer;

use Webit\Shipment\Vendor\VendorOptionValue;
use Webit\Shipment\Vendor\VendorOptionValueCollection;

class VendorOptionValueCollectionNormaliser
{
    /**
     * @param VendorOptionValueCollection $vendorOptionValueCollection
     * @return array
     */
    public function normalise(VendorOptionValueCollection $vendorOptionValueCollection)
    {
        $normalised = array();

        /**
         * @var string $key
         * @var VendorOptionValue $value
         */
        foreach ($vendorOptionValueCollection as $value) {
            $normalised[] = array(
                'option_code' => $value->getOptionCode(),
                'value' => $value->getValue()
            );
        }

        return $normalised;
    }

    /**
     * @param array $normalised
     * @return VendorOptionValueCollection
     */
    public function denormalise($normalised)
    {
        $values = array();
        foreach ($normalised as $option) {
            $values[] = new VendorOptionValue($option['option_code'], $option['value']);
        }

        return new VendorOptionValueCollection($values);
    }
}
