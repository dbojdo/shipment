<?php
/**
 * ConsignmentRepositoryInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 20, 2014, 15:12
 */

namespace Webit\Shipment\Consignment;

use Doctrine\Common\Collections\ArrayCollection;
use Webit\Tools\Data\FilterCollection;
use Webit\Tools\Data\SorterCollection;

/**
 * Interface ConsignmentRepositoryInterface
 * @package Webit\Shipment\Consignment
 */
interface ConsignmentRepositoryInterface
{
    /**
     * @param mixed $id
     * @return ConsignmentInterface
     */
    public function getConsignment($id);

    /**
     * @param FilterCollection $filters
     * @param SorterCollection $sorters
     * @param int $limit
     * @param int $offset
     * @return ArrayCollection
     */
    public function getConsignments(
        FilterCollection $filters = null,
        SorterCollection $sorters= null,
        $limit = 50,
        $offset = 0
    );

    /**
     * @return ConsignmentInterface
     */
    public function createConsignment();

    /**
     * @param ConsignmentInterface $consignment
     */
    public function saveConsignment(ConsignmentInterface $consignment);

    /**
     * @param ConsignmentInterface $consignment
     */
    public function removeConsignment(ConsignmentInterface $consignment);
}
