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
use Webit\Shipment\Vendor\VendorOptionCollection;
use Webit\Shipment\Vendor\VendorOptionValueCollection;

class VendorOptionCollectionHandler implements SubscribingHandlerInterface
{
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
                'method' => 'serializeCollection'
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
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'method' => 'deserializeVendorOptionValueCollection'
            );
        }

        return $supported;
    }

    public function serializeCollection(VisitorInterface $visitor, $data, $type, Context $context)
    {
        switch (true) {
            case $data instanceof VendorOptionValueCollection:
                $data = $data->getValues();
                break;
            case $data instanceof VendorOptionCollection:
                $data = $data->getOptions();
                break;
            default:
                throw new \UnexpectedValueException(
                    sprintf(
                        'Unsupported type: "%s"', is_object($data) ? get_class($data) : gettype($data)
                    )
                );
        }

        $type['name'] = 'array';

        return $context->accept($data, $type);
    }

    public function deserializeVendorOptionCollection(VisitorInterface $visitor, $data, $type, Context $context)
    {
        $collection = new VendorOptionCollection();
        foreach ($data as $option) {
            $collection->addOption($context->accept($option, array('name'=>'Webit\Shipment\Vendor\VendorOption')));
        }

        return $collection;
    }

    public function deserializeVendorOptionValueCollection(VisitorInterface $visitor, $data, $type, Context $context)
    {
        $collection = new VendorOptionValueCollection();
        foreach ($data as $value) {
            $collection->addValue($context->accept($value, array('name'=>'Webit\Shipment\Vendor\VendorOptionValue')));
        }

        return $collection;
    }
}
