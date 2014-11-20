<?php
/**
 * SenderAddressInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:07
 */

namespace Webit\Shipment\Address;

use Webit\Addressing\Model\CountryAwareAddressInterface;

/**
 * Class SenderAddressInterface
 * @package Webit\Shipment\Address
 */
interface SenderAddressInterface extends CountryAwareAddressInterface
{
}
