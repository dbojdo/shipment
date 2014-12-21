<?php
/**
 * File DeliveryAddressRepositoryInterface.php
 * Created at: 2014-12-18 14-20
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Address;


interface DeliveryAddressRepositoryInterface
{
    /**
     * @param DeliveryAddressInterface $deliveryAddress
     */
    public function saveDeliveryAddress(DeliveryAddressInterface $deliveryAddress);
} 