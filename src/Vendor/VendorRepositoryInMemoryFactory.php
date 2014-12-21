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
        $repository = new VendorRepositoryInMemory();

        /** @var VendorFactoryInterface $factory */
        foreach ($this->vendorFactories as $factory) {
            $repository->addVendor($factory->createVendor());
        }

        return $repository;
    }

    /**
     * @param VendorFactoryInterface $vendorFactory
     */
    public function addVendorFactory(VendorFactoryInterface $vendorFactory)
    {
        $this->vendorFactories[] = $vendorFactory;
    }
}
