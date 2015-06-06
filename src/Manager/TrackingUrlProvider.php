<?php
/**
 * File TrackingUrlProvider.php
 * Created at: 2015-06-06 13-11
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Manager;

use Webit\Shipment\Consignment\ConsignmentInterface;

class TrackingUrlProvider implements TrackingUrlProviderInterface
{
    /**
     * @var VendorAdapterProviderInterface
     */
    private $adapterProvider;

    /**
     * @param VendorAdapterProviderInterface $adapterProvider
     */
    public function __construct(VendorAdapterProviderInterface $adapterProvider)
    {
        $this->adapterProvider = $adapterProvider;
    }


    /**
     * @param ConsignmentInterface $consignment
     * @return string
     */
    public function getTrackingUrl(ConsignmentInterface $consignment)
    {
        $adapter = $this->adapterProvider->getVendorAdapter($consignment->getVendor());

        return $adapter->getConsignmentTrackingUrl($consignment);
    }
}
