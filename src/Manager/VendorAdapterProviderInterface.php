<?php
/**
 * File: VendorAdapterProviderInterface.php
 * Created at: 2014-11-21 06:07
 */
 
namespace Webit\Shipment\Manager;

use Webit\Shipment\Vendor\VendorInterface;

/**
 * Interface VendorAdapterProviderInterface
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
interface VendorAdapterProviderInterface
{
    /**
     * @param VendorInterface $vendor
     * @return VendorAdapterInterface
     */
    public function getVendorAdapter(VendorInterface $vendor);

    /**
     * @param VendorAdapterInterface $vendorAdapter
     */
    public function registerVendorAdapter(VendorAdapterInterface $vendorAdapter);
}
