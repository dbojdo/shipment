<?php
/**
 * File DefaultSenderAddressProviderInterface.php
 * Created at: 2015-01-11 11-56
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Address;


interface DefaultSenderAddressProviderInterface
{
    /**
     * @return SenderAddressInterface
     */
    public function getDefaultSenderAddress();
}
