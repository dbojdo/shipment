<?php
/**
 * File: VendorRepositoryInMemory.php
 * Created at: 2014-11-21 06:16
 */
 
namespace Webit\Shipment\Vendor;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Vendor\Exception\VendorFactoryNotFoundException;

/**
 * Class VendorRepositoryInMemory
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class VendorRepositoryInMemory implements VendorRepositoryInterface
{
    /**
     * @var VendorFactoryInterface[]
     */
    private $factories;

    /**
     * @var ArrayCollection
     */
    private $vendors;

    /**
     * @param VendorFactoryInterface[] $factories
     */
    public function __construct(array $factories)
    {
        $this->factories = $factories;
        $this->vendors = new ArrayCollection();
    }

    /**
     * @param string $code
     * @return VendorInterface
     */
    public function getVendor($code)
    {
        if (! $this->vendors->contains($code)) {
            $factory = isset($this->factories[$code]) ? $this->factories[$code] : null;
            if (! $factory) {
                throw new VendorFactoryNotFoundException(sprintf('Could not find Vendor Factory for code "%s"', $code));
            }

            $this->vendors->set($code, $factory->createVendor());
        }

        return $this->vendors->get($code);
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
}
