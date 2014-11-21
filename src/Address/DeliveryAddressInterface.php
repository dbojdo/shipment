<?php
/**
 * DeliveryAddressInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:08
 */

namespace Webit\Shipment\Address;

use Webit\Addressing\Model\ContactDetailsAwareAddressInterface;
use Webit\Addressing\Model\CountryAwareAddressInterface;

/**
 * Interface DeliveryAddressInterface
 * @package Webit\Shipment\Address
 */
interface DeliveryAddressInterface extends CountryAwareAddressInterface, ContactDetailsAwareAddressInterface
{
}
