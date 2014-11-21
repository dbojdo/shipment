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
     */
    public function registerVendorAdapter(VendorAdapterInterface $vendorAdapter)
    {
        if ($this->vendorAdapters->containsKey($vendorAdapter->getVendorCode())) {
            throw new VendorAdapterAlreadyRegisteredException(
                sprintf(
                    'Vendor adapter for vendor with code "%s" has been already registred.',
                    $vendorAdapter->getVendorCode()
                )
            );
        }

        $this->vendorAdapters->set($vendorAdapter->getVendorCode(), $vendorAdapter);
    }

}
 