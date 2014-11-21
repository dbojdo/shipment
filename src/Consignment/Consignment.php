<?php
/**
 * File: Consignment.php
 * Created at: 2014-11-21 07:37
 */
 
namespace Webit\Shipment\Consignment;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Address\DeliveryAddressInterface;
use Webit\Shipment\Address\SenderAddressInterface;
use Webit\Shipment\Parcel\ParcelInterface;
use Webit\Shipment\Vendor\VendorInterface;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

/**
 * Class Consignment
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class Consignment implements ConsignmentInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var VendorInterface
     */
    protected $vendor;

    /**
     * @var ArrayCollection
     */
    protected $vendorOptions;

    /**
     * @var string
     */
    protected $vendorStatus;

    /**
     * @var string
     */
    protected $vendorId;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var SenderAddressInterface
     */
    protected $senderAddress;

    /**
     * @var DeliveryAddressInterface
     */
    protected $deliveryAddress;

    /**
     * @var ArrayCollection
     */
    protected $parcels;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var DispatchConfirmationInterface
     */
    protected $dispatchConfirmation;

    /**
     * @return DeliveryAddressInterface
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param DeliveryAddressInterface $deliveryAddress
     */
    public function setDeliveryAddress(DeliveryAddressInterface $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return DispatchConfirmationInterface
     */
    public function getDispatchConfirmation()
    {
        return $this->dispatchConfirmation;
    }

    /**
     * @param DispatchConfirmationInterface $dispatchConfirmation
     */
    public function setDispatchConfirmation(DispatchConfirmationInterface $dispatchConfirmation)
    {
        $this->dispatchConfirmation = $dispatchConfirmation;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection
     */
    public function getParcels()
    {
        return $this->parcels;
    }

    /**
     * @param ArrayCollection $parcels
     */
    public function setParcels($parcels)
    {
        $this->parcels = $parcels;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return SenderAddressInterface
     */
    public function getSenderAddress()
    {
        return $this->senderAddress;
    }

    /**
     * @param SenderAddressInterface $senderAddress
     */
    public function setSenderAddress(SenderAddressInterface $senderAddress)
    {
        $this->senderAddress = $senderAddress;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return VendorInterface
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param VendorInterface $vendor
     */
    public function setVendor(VendorInterface $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return string
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @param string $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return ArrayCollection
     */
    public function getVendorOptions()
    {
        return $this->vendorOptions;
    }

    /**
     * @param ArrayCollection $vendorOptions
     */
    public function setVendorOptions($vendorOptions)
    {
        $this->vendorOptions = $vendorOptions;
    }

    /**
     * @return string
     */
    public function getVendorStatus()
    {
        return $this->vendorStatus;
    }

    /**
     * @param string $vendorStatus
     */
    public function setVendorStatus($vendorStatus)
    {
        $this->vendorStatus = $vendorStatus;
    }

    /**
     * @param string $code
     * @return VendorOptionValueInterface
     */
    public function getVendorOption($code)
    {
        // TODO: Implement getVendorOption() method.
    }

    /**
     * @param VendorOptionValueInterface $vendorOptionValue
     */
    public function setVendorOption(VendorOptionValueInterface $vendorOptionValue)
    {
        // TODO: Implement setVendorOption() method.
    }

    /**
     * @param VendorOptionValueInterface $vendorOptionValue
     */
    public function unsetVendorOption(VendorOptionValueInterface $vendorOptionValue)
    {
        // TODO: Implement unsetVendorOption() method.
    }

    /**
     * @param ParcelInterface $parcel
     */
    public function addParcel(ParcelInterface $parcel)
    {
        // TODO: Implement addParcel() method.
    }

    /**
     * @param ParcelInterface $parcel
     */
    public function removeParcel(ParcelInterface $parcel)
    {
        // TODO: Implement removeParcel() method.
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        // TODO: Implement getWeight() method.
    }


}
 