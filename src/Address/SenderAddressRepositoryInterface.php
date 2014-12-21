<?php
/**
 * File SenderAddressRepositoryInterface.php
 * Created at: 2014-12-18 14-21
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Address;


interface SenderAddressRepositoryInterface
{
    /**
     * @param SenderAddressInterface $senderAddress
     */
    public function saveSenderAddress(SenderAddressInterface $senderAddress);
}
