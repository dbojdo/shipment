<?php
/**
 * ConsignmentInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 14:46
 */

namespace Webit\Shipment\Consignment;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Address\DeliveryAddressInterface;
use Webit\Shipment\Address\SenderAddressInterface;
use Webit\Shipment\Parcel\ParcelInterface;
use Webit\Shipment\Vendor\VendorInterface;
use Webit\Shipment\Vendor\VendorOptionValueCollection;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

/**
 * Interface ConsignmentInterface
 * @package Webit\Shipment\Consignment
 */
interface ConsignmentInterface
{

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return VendorInterface
     */
    public function getVendor();

    /**
     * @param VendorInterface $vendor
     */
    public function setVendor(VendorInterface $vendor);

    /**
     * @return string
     */
    public function getVendorId();

    /**
     * @param string $vendorId
     */
    public function setVendorId($vendorId);

    /**
     * @return VendorOptionValueCollection
     */
    public function getVendorOptions();

    /**
     * @return string
     */
    public function getVendorStatus();

    /**
     * @param string $status
     */
    public function setVendorStatus($status);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     */
    public function setStatus($status);

    /**
     * @return bool
     */
    public function isAnonymous();

    /**
     * @param bool $anonymous
     */
    public function setAnonymous($anonymous);

    /**
     * @return SenderAddressInterface
     */
    public function getSenderAddress();

    /**
     * @param SenderAddressInterface $senderAddress
     */
    public function setSenderAddress(SenderAddressInterface $senderAddress = null);

    /**
     * @return DeliveryAddressInterface
     */
    public function getDeliveryAddress();

    /**
     * @param DeliveryAddressInterface $deliveryAddress
     */
    public function setDeliveryAddress(DeliveryAddressInterface $deliveryAddress);

    /**
     * @param ParcelInterface $parcel
     */
    public function addParcel(ParcelInterface $parcel);

    /**
     * @param ParcelInterface $parcel
     */
    public function removeParcel(ParcelInterface $parcel);

    /**
     * @return ArrayCollection
     */
    public function getParcels();

    /**
     * @return string
     */
    public function getReference();

    /**
     * @param string $reference
     */
    public function setReference($reference);

    /**
     * @return float
     */
    public function getWeight();

    /**
     * @return bool
     */
    public function isCod();

    /**
     * @param bool $cod
     */
    public function setCod($cod);

    /**
     * @return float
     */
    public function getCodAmount();

    /**
     * @param float $amount
     */
    public function setCodAmount($amount);

    /**
     * @return DispatchConfirmationInterface
     */
    public function getDispatchConfirmation();

    /**
     * @param DispatchConfirmationInterface $consignmentDispatchConfirmation
     */
    public function setDispatchConfirmation(DispatchConfirmationInterface $consignmentDispatchConfirmation);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();
}
