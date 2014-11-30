<?php
/**
 * File: VendorFactoryInterface.php
 * Created at: 2014-11-21 06:13
 */
 
namespace Webit\Shipment\Vendor;

/**
 * Interface VendorFactoryInterface
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
interface VendorFactoryInterface
{
    /**
     *
     * @return VendorInterface
     */
    public function createVendor();
}
 