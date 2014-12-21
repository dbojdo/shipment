<?php
/**
 * File: ParcelRepositoryInterface.php
 * Created at: 2014-12-01 04:08
 */
 
namespace Webit\Shipment\Parcel;

use Webit\Shipment\Vendor\VendorInterface;

/**
 * Class ParcelRepositoryInterface
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
interface ParcelRepositoryInterface
{
    /**
     * @return ParcelInterface
     */
    public function createParcel();

    /**
     * @param VendorInterface $vendor
     * @param string $number
     * @return ParcelInterface
     */
    public function getParcel(VendorInterface $vendor, $number);
}
