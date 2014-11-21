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
    protected $dispatchedAt;

    /**
     * @return ArrayCollection
     */
    public function getConsignments()
    {
        if ($this->consignments == null) {
            $this->consignments = new ArrayCollection();
        }

        return $this->consignments;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return \DateTime
     */
    public function getDispatchedAt()
    {
        return $this->dispatchedAt;
    }

    /**
     * @param \DateTime $dispatchedAt
     */
    public function setDispatchedAt(\DateTime $dispatchedAt)
    {
        $this->dispatchedAt = $dispatchedAt;
    }

}
