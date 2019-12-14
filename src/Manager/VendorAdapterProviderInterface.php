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
     * @param string $vendorCode
     * @return VendorAdapterInterface
     */
    public function getVendorAdapter($vendorCode);

    /**
     * @param VendorAdapterInterface $vendorAdapter
     * @param string $vendorCode
     */
    public function registerVendorAdapter(VendorAdapterInterface $vendorAdapter, $vendorCode);
}
