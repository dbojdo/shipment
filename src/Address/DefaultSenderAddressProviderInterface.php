<?php
/**
 * File DefaultSenderAddressProviderInterface.php
 * Created at: 2017-09-16 11:59
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Address;

interface DefaultSenderAddressProviderInterface
{
    /**
     * @return SenderAddressInterface
     */
    public function getSender();
}
