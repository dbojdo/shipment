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
use Webit\Shipment\Vendor\VendorOptionValueCollection;

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
     * @var VendorOptionValueCollection
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
     * @var bool
     */
    protected $anonymous = false;

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
     * @var bool
     */
    protected $cod = false;

    /**
     * @var float
     */
    protected $codAmount;

    /**
     * @var DispatchConfirmationInterface
     */
    protected $dispatchConfirmation;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

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
    public function setDispatchConfirmation(DispatchConfirmationInterface $dispatchConfirmation = null)
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
     * @return ArrayCollection
     */
    public function getParcels()
    {
        if ($this->parcels == null) {
            $this->parcels = new ArrayCollection();
        }

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
     * @return bool
     */
    public function isAnonymous()
    {
        return $this->anonymous;
    }

    /**
     * @param bool $anonymous
     */
    public function setAnonymous($anonymous)
    {
        $this->anonymous = (bool) $anonymous;
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
    public function setSenderAddress(SenderAddressInterface $senderAddress = null)
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
     * @return boolean
     */
    public function isCod()
    {
        return $this->cod;
    }

    /**
     * @param boolean $cod
     */
    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    /**
     * @return float
     */
    public function getCodAmount()
    {
        return $this->codAmount;
    }

    /**
     * @param float $codAmount
     */
    public function setCodAmount($codAmount)
    {
        $this->codAmount = $codAmount;
        $this->setCod($codAmount > 0);
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
     * @return ArrayCollection
     */
    public function getVendorOptions()
    {
        if ($this->vendorOptions == null) {
            $this->vendorOptions = new VendorOptionValueCollection();
        }

        return $this->vendorOptions;
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
     * @param ParcelInterface $parcel
     */
    public function addParcel(ParcelInterface $parcel)
    {
        if (! $this->getParcels()->contains($parcel)) {
            $parcel->setConsignment($this);
            $this->getParcels()->add($parcel);
        }
    }

    /**
     * @param ParcelInterface $parcel
     */
    public function removeParcel(ParcelInterface $parcel)
    {
        if ($this->getParcels()->contains($parcel)) {
            $this->getParcels()->removeElement($parcel);
        }
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        $weight = 0;
        /** @var ParcelInterface $parcel */
        foreach ($this->getParcels() as $parcel) {
            $weight += $parcel->getWeight();
        }

        return $weight;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function ensureParcelsRelation()
    {
        /** @var ParcelInterface $parcel */
        foreach ($this->getParcels() as $parcel) {
            if (! $parcel->getConsignment()) {
                $parcel->setConsignment($this);
            }
        }
    }
}
