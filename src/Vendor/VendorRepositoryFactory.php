<?php
/**
 * File: VendorRepositoryInMemoryFactory.php
 * Created at: 2014-11-30 20:38
 */
 
namespace Webit\Shipment\Vendor;

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class VendorRepositoryInMemoryFactory
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class VendorRepositoryFactory
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
    public function createInMemoryRepository()
    {
        $repository = new VendorRepositoryInMemory($this->vendorFactories->toArray());

        return $repository;
    }

    /**
     * @return VendorRepositoryCached
     */
    public function createCachedRepository(Cache $cache)
    {
        $repository = new VendorRepositoryCached($cache, $this->vendorFactories->toArray());

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
