<?php
/**
 * File VendorOptionValueCollectionType.php
 * Created at: 2016-03-20 21-20
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonArrayType;
use Webit\Shipment\Serializer\VendorOptionValueCollectionNormaliser;

class VendorOptionValueCollectionType extends JsonArrayType
{
    const TYPE_NAME = 'webit_shipment.vendor_option_value_collection';

    /**
     * @var VendorOptionValueCollectionNormaliser
     */
    private static $normaliser;

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value) {
            $value = $this->normaliser()->normalise($value);
        }

        return parent::convertToDatabaseValue($value, $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        $normalised = parent::convertToPHPValue($value, $platform);

        return $this->normaliser()->denormalise($normalised);
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return self::TYPE_NAME;
    }

    /**
     * @return VendorOptionValueCollectionNormaliser
     */
    private function normaliser()
    {
        if (! self::$normaliser) {
            self::$normaliser = new VendorOptionValueCollectionNormaliser();
        }

        return self::$normaliser;
    }
}
