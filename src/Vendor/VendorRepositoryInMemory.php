<?php
/**
 * File: VendorRepositoryInMemory.php
 * Created at: 2014-11-21 06:16
 */
 
namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Vendor\Exception\VendorAlreadyExistsException;

/**
 * Class VendorRepositoryInMemory
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class VendorRepositoryInMemory implements VendorRepositoryInterface
{
    /**
     * @var ArrayCollection
     */
    private $vendors;

    public function __construct()
    {
        $this->vendors = new ArrayCollection();
    }

    /**
     * @param string $code
     * @return VendorInterface
     */
    public function getVendor($code)
    {
        return $this->vendors->get($code);
    }

    /**
     * @return ArrayCollection
     */
    public function getVendors()
    {
        return $this->vendors;
    }

    /**
     * @param VendorInterface $vendor
     */
    public function addVendor(VendorInterface $vendor)
    {
        if ($this->vendors->containsKey($vendor->getCode())) {
            throw new VendorAlreadyExistsException(
                sprintf('Vendor with code "%s" already exists in repository.', $vendor->getCode())
            );
        }

        $this->vendors->set($vendor->getCode(), $vendor);
    }

    /**
     * @param VendorInterface $vendor
     */
    public function removeVendor(VendorInterface $vendor)
    {
        $this->vendors->remove($vendor->getCode());
    }
}
