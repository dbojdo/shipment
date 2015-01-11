<?php
/**
 * File DefaultSenderAddressProvider.php
 * Created at: 2015-01-11 11-58
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Address;


class DefaultSenderAddressProvider implements DefaultSenderAddressProviderInterface
{

    /**
     * @var SenderAddressInterface
     */
    private $senderAddress;

    /**
     * @param SenderAddressInterface $senderAddress
     */
    public function __construct(SenderAddressInterface $senderAddress)
    {
        $this->senderAddress = $senderAddress;
    }

    /**
     * @return SenderAddressInterface
     */
    public function getDefaultSenderAddress()
    {
        return $this->senderAddress;
    }
}
