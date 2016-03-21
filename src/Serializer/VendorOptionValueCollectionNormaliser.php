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
        foreach ($vendorOptionValueCollection as $key => $value) {
            $normalised[$key] = $value->getValue();
        }

        return $normalised;
    }

    /**
     * @param array $normalised
     * @return VendorOptionCollection
     */
    public function denormalise($normalised)
    {
        $optionValues = new VendorOptionValueCollection();
        foreach ($normalised as $key => $value) {
            $optionValue = new VendorOptionValue($key);
            $optionValue->setValue($value);
            $optionValues->addValue($optionValue);
        }

        return $optionValues;
    }
}
