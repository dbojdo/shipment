<?php
/**
 * File: VendorAdapterProvider.php
 * Created at: 2014-11-21 06:41
 */
 
namespace Webit\Shipment\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Manager\Exception\VendorAdapterAlreadyRegisteredException;
use Webit\Shipment\Vendor\VendorInterface;

/**
 * Class VendorAdapterProvider
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class VendorAdapterProvider implements VendorAdapterProviderInterface
{
    /**
     * @var ArrayCollection
     */
    private $vendorAdapters;

    public function __construct()
    {
        $this->vendorAdapters = new ArrayCollection();
    }

    /**
     * @param VendorInterface $vendor
     * @return VendorAdapterProviderInterface
     */
    public function getVendorAdapter(VendorInterface $vendor)
    {
        return $this->vendorAdapters->get($vendor->getCode());
    }

    /**
     * @param VendorAdapterInterface $vendorAdapter
     * @param string $vendorCode
     */
    public function registerVendorAdapter(VendorAdapterInterface $vendorAdapter, $vendorCode)
    {
        if ($this->vendorAdapters->containsKey($vendorCode)) {
            throw new VendorAdapterAlreadyRegisteredException(
                sprintf(
                    'Vendor adapter for vendor with code "%s" has been already registered.',
                    $vendorCode
                )
            );
        }

        $this->vendorAdapters->set($vendorCode, $vendorAdapter);
    }

}
 