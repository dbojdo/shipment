<?php
/**
 * File: VendorRepositoryInMemoryFactory.php
 * Created at: 2014-11-30 20:38
 */
 
namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class VendorRepositoryInMemoryFactory
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class VendorRepositoryInMemoryFactory
{
    /**
     * @var ArrayCollection
     */
    private $vendorFactories;

    public function __construct()
    {
        $this->vendorFactories = new ArrayCollection();
    }

    /**
     * @return VendorRepositoryInMemory
     */
    public function createVendorRepository()
    {
        $repository = new VendorRepositoryInMemory($this->vendorFactories->toArray());

        return $repository;
    }

    /**
     * @param VendorFactoryInterface $vendorFactory
     * @param string $vendorCode
     */
    public function addVendorFactory(VendorFactoryInterface $vendorFactory, $vendorCode)
    {
        $this->vendorFactories->set($vendorCode, $vendorFactory);
    }
}
