<?php
/**
 * File VendorOptionCollectionType.php
 * Created at: 2016-03-20 21-05
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonArrayType;
use Webit\Shipment\Serializer\VendorOptionCollectionNormaliser;

class VendorOptionCollectionType extends JsonArrayType
{
    const TYPE_NAME = 'webit_shipment.vendor_option_collection';

    /**
     * @var VendorOptionCollectionNormaliser
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
        $normalised = parent::convertToPHPValue($value, $platform);
        if ($normalised) {
            return $this->normaliser()->denormalise($normalised);
        }

        return $normalised;
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
     * @return VendorOptionCollectionNormaliser
     */
    private function normaliser()
    {
        if (! self::$normaliser) {
            self::$normaliser = new VendorOptionCollectionNormaliser();
        }

        return self::$normaliser;
    }
}
