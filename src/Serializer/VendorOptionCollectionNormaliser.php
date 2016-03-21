<?php
/**
 * File VendorOptionCollectionNormaliser.php
 * Created at: 2016-03-20 20-51
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Serializer;

use Webit\Shipment\Vendor\VendorOption;
use Webit\Shipment\Vendor\VendorOptionCollection;

class VendorOptionCollectionNormaliser
{

    /**
     * @param VendorOptionCollection $vendorOptionCollection
     * @return array
     */
    public function normalise(VendorOptionCollection $vendorOptionCollection)
    {
        $normalised = array();
        /**
         * @var string $key
         * @var VendorOption $value
         */
        foreach ($vendorOptionCollection as $key => $value) {
            $normalised[$key] = array(
                'code' => $value->getCode(),
                'name' => $value->getName(),
                'description' => $value->getDescription(),
                'allowed_values' => $value->getAllowedValues()->toArray()
            );
        }

        return $normalised;
    }

    /**
     * @param array $normalised
     * @return VendorOptionCollection
     */
    public function denormalise($normalised)
    {
        $options = new VendorOptionCollection();
        foreach ($normalised as $key => $arOption) {
            $option = $this->denormaliseOption($arOption);
            $options->addOption($option);
        }

        return $options;
    }

    /**
     * @param array $arOption
     * @return VendorOption
     */
    private function denormaliseOption(array $arOption)
    {
        $option = new VendorOption();

        if (isset($arOption['code'])) {
            $option->setCode($arOption['code']);
        }

        if (isset($arOption['name'])) {
            $option->setName($arOption['name']);
        }

        if (isset($arOption['description'])) {
            $option->setDescription($arOption['description']);
        }

        $allowedValues = isset($arOption['allowed_values']) ? (array) $arOption['allowed_values'] : array();
        foreach ($allowedValues as $value) {
            $option->addAllowedValue($value);
        }

        return $option;
    }
}
