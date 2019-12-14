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
     * @var string
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
     * @var array
     */
    protected $vendorData = array();

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
     * @var ArrayCollection|ParcelInterface[]
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
     * @inheritdoc
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @inheritdoc
     */
    public function setDeliveryAddress(DeliveryAddressInterface $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @inheritdoc
     */
    public function getDispatchConfirmation()
    {
        return $this->dispatchConfirmation;
    }

    /**
     * @inheritdoc
     */
    public function setDispatchConfirmation(DispatchConfirmationInterface $dispatchConfirmation = null)
    {
        $this->dispatchConfirmation = $dispatchConfirmation;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getParcels()
    {
        if ($this->parcels == null) {
            $this->parcels = new ArrayCollection();
        }

        return $this->parcels;
    }

    /**
     * @inheritdoc
     */
    public function setParcels($parcels)
    {
        $this->parcels = $parcels;
    }

    /**
     * @inheritdoc
     */
    public function findParcel($reference)
    {
        $parcels = $this->getParcels()->filter(function ($parcel) use ($reference) {
            return $parcel->getReference() == $reference;
        });

        return $parcels->first();
    }

    /**
     * @inheritdoc
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @inheritdoc
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }


    /**
     * @inheritdoc
     */
    public function isAnonymous()
    {
        return $this->anonymous;
    }

    /**
     * @inheritdoc
     */
    public function setAnonymous($anonymous)
    {
        $this->anonymous = (bool) $anonymous;
    }

    /**
     * @inheritdoc
     */
    public function getSenderAddress()
    {
        return $this->senderAddress;
    }

    /**
     * @inheritdoc
     */
    public function setSenderAddress(SenderAddressInterface $senderAddress = null)
    {
        $this->senderAddress = $senderAddress;
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @inheritdoc
     */
    public function isCod()
    {
        return $this->cod;
    }

    /**
     * @inheritdoc
     */
    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    /**
     * @inheritdoc
     */
    public function getCodAmount()
    {
        return $this->codAmount;
    }

    /**
     * @inheritdoc
     */
    public function setCodAmount($codAmount)
    {
        $this->codAmount = $codAmount;
        $this->setCod($codAmount > 0);
    }

    /**
     * @inheritdoc
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @inheritdoc
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @inheritdoc
     */
    public function getVendorOptions()
    {
        if ($this->vendorOptions == null) {
            $this->vendorOptions = new VendorOptionValueCollection();
        }

        return $this->vendorOptions;
    }

    /**
     * @inheritdoc
     */
    public function getVendorStatus()
    {
        return $this->vendorStatus;
    }

    /**
     * @inheritdoc
     */
    public function setVendorStatus($vendorStatus)
    {
        $this->vendorStatus = $vendorStatus;
    }

    /**
     * @inheritdoc
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @inheritdoc
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @inheritdoc
     */
    public function addParcel(ParcelInterface $parcel)
    {
        if (! $this->getParcels()->contains($parcel)) {
            $parcel->setConsignment($this);
            $this->getParcels()->add($parcel);
        }
    }

    /**
     * @inheritdoc
     */
    public function removeParcel(ParcelInterface $parcel)
    {
        if ($this->getParcels()->contains($parcel)) {
            $this->getParcels()->removeElement($parcel);
        }
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function ensureParcelsRelation()
    {
        foreach ($this->getParcels() as $parcel) {
            if (! $parcel->getConsignment()) {
                $parcel->setConsignment($this);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function getVendorData()
    {
        return $this->vendorData ?: array();
    }

    /**
     * @inheritdoc
     */
    public function setVendorData(array $data)
    {
        $this->vendorData = $data;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return $this->getParcels()->getIterator();
    }

    /**
     * @inheritdoc
     */
    public function addVendorData($key, $data)
    {
        $vendorData = $this->getVendorData();
        $vendorData[$key] = $data;
        $this->setVendorData($vendorData);
    }
}
