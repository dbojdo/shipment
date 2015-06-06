<?php
/**
 * File TrackingUrlProviderInterface.php
 * Created at: 2015-06-06 13-10
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Manager;

use Webit\Shipment\Consignment\ConsignmentInterface;

interface TrackingUrlProviderInterface
{
    /**
     * @param ConsignmentInterface $consignment
     * @return string
     */
    public function getTrackingUrl(ConsignmentInterface $consignment);
}
