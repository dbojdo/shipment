<?php

namespace Webit\Shipment\Consignment;

use Doctrine\Common\Collections\ArrayCollection;

class DispatchConfirmation implements DispatchConfirmationInterface
{
    /**
     * @var ArrayCollection
     */
    protected $consignments;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var \DateTime
     */
    protected $pickUpAt;

    /**
     * @var bool
     */
    protected $courierCalled = false;

    /**
     * @var \DateTime
     */
    protected $dispatchedAt;

    /**
     * @var array
     */
    protected $vendorData = array();

    /**
     * @inheritdoc
     */
    public function getConsignments()
    {
        if ($this->consignments == null) {
            $this->consignments = new ArrayCollection();
        }

        return $this->consignments;
    }

    /**
     * @inheritdoc
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @inheritdoc
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @inheritdoc
     */
    public function getDispatchedAt()
    {
        return $this->dispatchedAt;
    }

    /**
     * @inheritdoc
     */
    public function setDispatchedAt(\DateTime $dispatchedAt)
    {
        $this->dispatchedAt = $dispatchedAt;
    }

    /**
     * @inheritdoc
     */
    public function getPickUpAt()
    {
        return $this->pickUpAt;
    }

    /**
     * @inheritdoc
     */
    public function setPickUpAt(\DateTime $pickUpAt)
    {
        $this->pickUpAt = $pickUpAt;
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
    public function isCourierCalled()
    {
        return (bool)$this->courierCalled;
    }

    /**
     * @inheritdoc
     */
    public function setCourierCalled($courierCalled)
    {
        $this->courierCalled = (bool)$courierCalled;
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
