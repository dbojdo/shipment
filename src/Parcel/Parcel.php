<?php
/**
 * File: Parcel.php
 * Created at: 2014-11-21 07:08
 */
 
namespace Webit\Shipment\Parcel;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Parcel\Exception\InvalidVendorOptionValueException;
use Webit\Shipment\Vendor\VendorOptionValueInterface;

/**
 * Class Parcel
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class Parcel implements ParcelInterface
{
    /**
     * @var string
     */
    protected $number;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var ArrayCollection
     */
    protected $vendorOptions;

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
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
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
     * @return ArrayCollection
     */
    public function getVendorOptions()
    {
        if ($this->vendorOptions == null) {
            $this->vendorOptions = new ArrayCollection();
        }

        return $this->vendorOptions;
    }

    /**
     * @param string $code
     * @return VendorOptionValueInterface
     */
    public function getVendorOption($code)
    {
        return $this->getVendorOptions()->get($code);
    }

    /**
     * @param VendorOptionValueInterface $vendorOptionValue
     */
    public function setVendorOption(VendorOptionValueInterface $vendorOptionValue)
    {
        $option = $vendorOptionValue->getOption();
        if (! $option || ! $option->getCode()) {
            throw new InvalidVendorOptionValueException(
                'Given vendor option value doesn\'t contain option or option code is empty.'
            );
        }

        $this->getVendorOptions()->set($option->getCode(), $vendorOptionValue);
    }

    /**
     * @param VendorOptionValueInterface $vendorOptionValue
     */
    public function unsetVendorOption(VendorOptionValueInterface $vendorOptionValue)
    {
        $option = $vendorOptionValue->getOption();
        if ($option && $option->getCode()) {
            $this->getVendorOptions()->remove($option->getCode());
        }
    }
}
