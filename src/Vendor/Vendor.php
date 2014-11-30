<?php
/**
 * File: Vendor.php
 * Created at: 2014-11-30 19:14
 */
 
namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Vendor
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class Vendor implements VendorInterface
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var ArrayCollection
     */
    protected $consignmentOptions;

    /**
     * @var ArrayCollection
     */
    protected $parcelOptions;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var ArrayCollection
     */
    protected $labelPrintModes;

    /**
     * @var ArrayCollection
     */
    protected $dispatchConfirmationPrintModes;

    /**
     * @param string $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return ArrayCollection
     */
    public function getConsignmentOptions()
    {
        return $this->consignmentOptions;
    }

    /**
     * @return ArrayCollection
     */
    public function getParcelOptions()
    {
        if ($this->parcelOptions == null) {
            $this->parcelOptions = new ArrayCollection();
        }

        return $this->parcelOptions;
    }

    /**
     * @return ArrayCollection
     */
    public function getLabelPrintModes()
    {
        if ($this->labelPrintModes == null) {
            $this->labelPrintModes = new ArrayCollection();
        }

        return $this->labelPrintModes;
    }

    /**
     * @return ArrayCollection
     */
    public function getDispatchConfirmationPrintModes()
    {
        if ($this->dispatchConfirmationPrintModes == null) {
            $this->dispatchConfirmationPrintModes = new ArrayCollection();
        }

        return $this->dispatchConfirmationPrintModes;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}
