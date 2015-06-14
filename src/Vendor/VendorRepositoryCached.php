<?php
/**
 * File VendorRepositoryCached.php
 * Created at: 2015-06-14 06-35
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Vendor;

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Vendor\Exception\VendorFactoryNotFoundException;

class VendorRepositoryCached implements VendorRepositoryInterface
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var VendorFactoryInterface[]
     */
    private $factories;

    /**
     * @param Cache $cache
     * @param VendorFactoryInterface[] $factories
     */
    public function __construct(Cache $cache, array $factories)
    {
        $this->cache = $cache;
        $this->factories = $factories;
    }

    /**
     * @param string $code
     * @return VendorInterface
     */
    public function getVendor($code)
    {
        $cacheKey = $this->createCacheKey($code);
        if (! $this->cache->contains($cacheKey)) {
            $factory = isset($this->factories[$code]) ? $this->factories[$code] : null;
            if (! $factory) {
                throw new VendorFactoryNotFoundException(sprintf('Could not find Vendor Factory for code "%s"', $code));
            }

            $this->cache->save($cacheKey, $factory->createVendor());
        }

        return $this->cache->fetch($cacheKey);
    }

    /**
     * @return ArrayCollection
     */
    public function getVendors()
    {
        $vendors = array();
        foreach ($this->factories as $code => $factory) {
            $vendors[] = $this->getVendor($code);
        }

        return new ArrayCollection($vendors);
    }

    /**
     * @param string $code
     * @return string
     */
    private function createCacheKey($code)
    {
        return 'webit_shipment_vendor_' . $code;
    }
}
