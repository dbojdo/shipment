<?php
/**
 * File: VendorRepositoryInterface.php
 * Created at: 2014-11-21 06:06
 */
 
namespace Webit\Shipment\Vendor;

/**
 * Interface VendorRepositoryInterface
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
interface VendorRepositoryInterface
{

    /**
     * @param string $code
     * @return VendorInterface
     */
    public function getVendor($code);

    /**
     * @return ArrayCollection
     */
    public function getVendors();

    /**
     * @param VendorInterface $vendor
     */
    public function addVendor(VendorInterface $vendor);

    /**
     * @param VendorInterface $vendor
     */
    public function removeVendor(VendorInterface $vendor);
}
 