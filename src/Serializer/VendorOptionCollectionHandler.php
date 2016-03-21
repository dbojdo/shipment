<?php
/**
 * File VendorOptionCollectionHandler.php
 * Created at: 2014-12-30 07-06
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Serializer;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;

class VendorOptionCollectionHandler implements SubscribingHandlerInterface
{
    /**
     * @var VendorOptionCollectionNormaliser
     */
    private $vendorOptionCollectionNormaliser;

    /**
     * @var VendorOptionValueCollectionNormaliser
     */
    private $vendorOptionValueCollectionNormaliser;

    /**
     * VendorOptionCollectionHandler constructor.
     * @param VendorOptionCollectionNormaliser $vendorOptionCollectionSerialiser
     * @param VendorOptionValueCollectionNormaliser $vendorOptionValueCollectionSerialiser
     */
    public function __construct(
        VendorOptionCollectionNormaliser $vendorOptionCollectionSerialiser,
        VendorOptionValueCollectionNormaliser $vendorOptionValueCollectionSerialiser
    ) {
        $this->vendorOptionCollectionNormaliser = $vendorOptionCollectionSerialiser;
        $this->vendorOptionValueCollectionNormaliser = $vendorOptionValueCollectionSerialiser;
    }

    /**
     * Return format:
     *
     *      array(
     *          array(
     *              'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
     *              'format' => 'json',
     *              'type' => 'DateTime',
     *              'method' => 'serializeDateTimeToJson',
     *          ),
     *      )
     *
     * The direction and method keys can be omitted.
     *
     * @return array
     */
    public static function getSubscribingMethods()
    {
        $supported = array();
        foreach (array('json', 'xml') as $format) {
            $supported[] = array(
                'format' => $format,
                'type' => 'Webit\Shipment\Vendor\VendorOptionCollection',
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method' => 'serializeOptionCollection'
            );

            $supported[] = array(
                'format' => $format,
                'type' => 'Webit\Shipment\Vendor\VendorOptionCollection',
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'method' => 'deserializeVendorOptionCollection'
            );

            $supported[] = array(
                'format' => $format,
                'type' => 'Webit\Shipment\Vendor\VendorOptionValueCollection',
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method' => 'serializeOptionValueCollection'
            );

            $supported[] = array(
                'format' => $format,
                'type' => 'Webit\Shipment\Vendor\VendorOptionValueCollection',
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'method' => 'deserializeVendorOptionValueCollection'
            );
        }

        return $supported;
    }

    /**
     * @param VisitorInterface $visitor
     * @param $data
     * @param $type
     * @param Context $context
     * @return array|null
     */
    public function serializeOptionCollection(VisitorInterface $visitor, $data, $type, Context $context)
    {
        if ($data) {
            return $this->vendorOptionCollectionNormaliser->normalise($data);
        }

        return null;
    }

    /**
     * @param VisitorInterface $visitor
     * @param $data
     * @param $type
     * @param Context $context
     * @return array|null
     */
    public function serializeOptionValueCollection(VisitorInterface $visitor, $data, $type, Context $context)
    {
        if ($data) {
            return $this->vendorOptionValueCollectionNormaliser->normalise($data);
        }

        return null;
    }

    /**
     * @param VisitorInterface $visitor
     * @param $data
     * @param $type
     * @param Context $context
     * @return \Webit\Shipment\Serializer\VendorOptionCollection
     */
    public function deserializeVendorOptionCollection(VisitorInterface $visitor, $data, $type, Context $context)
    {
        return $this->vendorOptionCollectionNormaliser->denormalise($data);
    }

    /**
     * @param VisitorInterface $visitor
     * @param $data
     * @param $type
     * @param Context $context
     * @return \Webit\Shipment\Serializer\VendorOptionCollection
     */
    public function deserializeVendorOptionValueCollection(VisitorInterface $visitor, $data, $type, Context $context)
    {
        return $this->vendorOptionValueCollectionNormaliser->denormalise($data);
    }
}
