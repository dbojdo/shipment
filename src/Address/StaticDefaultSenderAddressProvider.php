<?php
/**
 * File StaticDefaultSenderAddressProvider.php
 * Created at: 2017-09-16 12:00
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Address;

class StaticDefaultSenderAddressProvider implements DefaultSenderAddressProviderInterface
{
    /**
     * @var SenderAddressInterface
     */
    private $sender;

    /**
     * StaticDefaultSenderAddressProvider constructor.
     * @param SenderAddressInterface $sender
     */
    public function __construct(SenderAddressInterface $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @inheritdoc
     */
    public function getSender()
    {
        return $this->sender;
    }
}