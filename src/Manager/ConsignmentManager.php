<?php
/**
 * File: ConsignmentManager.php
 * Created at: 2014-11-23 16:19
 */
 
namespace Webit\Shipment\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Webit\Shipment\Consignment\ConsignmentRepositoryInterface;
use Webit\Shipment\Event\EventConsignment;
use Webit\Shipment\Event\Events;
use Webit\Shipment\Manager\Exception\VendorAdapterNotFoundException;
use Webit\Shipment\Parcel\ParcelInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Webit\Shipment\Consignment\DispatchConfirmationInterface;
use Webit\Shipment\Consignment\ConsignmentInterface;

/**
 * Class ConsignmentManager
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */
class ConsignmentManager implements ConsignmentManagerInterface
{

    /**
     * @var VendorAdapterProviderInterface
     */
    private $adapterProvider;

    /**
     * @var ConsignmentRepositoryInterface
     */
    private $consignmentRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param VendorAdapterProviderInterface $adapterProvider
     * @param ConsignmentRepositoryInterface $consignmentRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        VendorAdapterProviderInterface $adapterProvider,
        ConsignmentRepositoryInterface $consignmentRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->adapterProvider = $adapterProvider;
        $this->consignmentRepository = $consignmentRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param ConsignmentInterface $consignment
     * @throws \Exception
     */
    public function synchronizeConsignment(ConsignmentInterface $consignment)
    {
        $adapter = $this->getAdapter($consignment);

        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::PRE_CONSIGNMENT_SYNCHRONIZE, $event);

        try {
            $adapter->synchronizeConsignment($consignment);
            $this->consignmentRepository->saveConsignment($consignment);
        } catch (\Exception $e) {
            throw $e;
        }

        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::POST_CONSIGNMENT_SYNCHRONIZE, $event);
    }

    /**
     * Save given consignment
     * @param ConsignmentInterface $consignment
     * @throws \Exception
     */
    public function saveConsignment(ConsignmentInterface $consignment)
    {
        $adapter = $this->getAdapter($consignment);

        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::PRE_CONSIGNMENT_SAVE, $event);

        try {
            $adapter->saveConsignment($consignment);
            $this->consignmentRepository->saveConsignment($consignment);
        } catch (\Exception $e) {
            throw $e;
        }

        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::POST_CONSIGNMENT_SAVE, $event);
    }

    /**
     * @param ArrayCollection $consignments
     * @throws \Exception
     */
    public function synchronizeConsignmentsStatus(ArrayCollection $consignments)
    {
        /** @var ConsignmentInterface $consignment */
        foreach ($consignments as $consignment) {
            $adapter = $this->getAdapter($consignment);
            $event = new EventConsignment($consignment);
            $this->eventDispatcher->dispatch(Events::PRE_CONSIGNMENT_STATUS_SYNCHRONIZE, $event);

            try {
                $status = $adapter->getConsignmentsStatus($consignment);
                $consignment->setVendorStatus($status);

                $shipmentStatus = $adapter->mapVendorStatus($status);
                $consignment->setStatus($shipmentStatus);
                $this->consignmentRepository->saveConsignment($consignment);
            } catch (\Exception $e) {
                throw $e;
            }

            $event = new EventConsignment($consignment);
            $this->eventDispatcher->dispatch(Events::POST_CONSIGNMENT_STATUS_SYNCHRONIZE, $event);
        }
    }

    /**
     * Remove given consignment. Allowed only in "new" status
     * @param ConsignmentInterface $consignment
     */
    public function removeConsignment(ConsignmentInterface $consignment)
    {
        $adapter = $this->getAdapter($consignment);
        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::PRE_CONSIGNMENT_REMOVE, $event);

        try {
            $adapter->removeConsignment($consignment);
            $this->consignmentRepository->removeConsignment($consignment);
        } catch (\Exception $e) {
            throw $e;
        }

        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::POST_CONSIGNMENT_REMOVE, $event);
    }

    /**
     * Prepare given consignments. Change status from new -> prepared
     * @param ArrayCollection $consignments
     * @throws \Exception
     * @return DispatchConfirmationInterface
     */
    public function dispatchConsignments(ArrayCollection $consignments)
    {
        $consignmentsByVendor = new ArrayCollection();

        /** @var ConsignmentInterface $consignment */
        foreach ($consignments as $consignment) {
            $vendor = $consignment->getVendor();
            if (! $consignmentsByVendor->containsKey($vendor->getCode())) {
                $consignmentsByVendor->set($vendor->getCode(), new ArrayCollection());
            }
            $event = new EventConsignment($consignment);
            $this->eventDispatcher->dispatch(Events::PRE_CONSIGNMENT_DISPATCH, $event);
            $consignmentsByVendor->get($vendor->getCode())->add($consignment);
        }

        foreach ($consignmentsByVendor as $vendorCode => $consignments) {
            $adapter = $this->getAdapter($consignments->first());
            try {
                $confirmation = $adapter->dispatchConsignments($consignments);
                foreach ($consignments as $consignment) {
                    $consignment->setDispatchConfirmation($confirmation);

                    $event = new EventConsignment($consignment);
                    $this->eventDispatcher->dispatch(Events::POST_CONSIGNMENT_DISPATCH, $event);
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }

    /**
     * Cancel given consignment. Allowed only in status different than "new".
     * @param ConsignmentInterface $consignment
     * @throws \Exception
     */
    public function cancelConsignment(ConsignmentInterface $consignment)
    {
        $adapter = $this->getAdapter($consignment);
        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::PRE_CONSIGNMENT_CANCEL, $event);

        try {
            $adapter->cancelConsignment($consignment);
        } catch (\Exception $e) {
            throw $e;
        }

        $event = new EventConsignment($consignment);
        $this->eventDispatcher->dispatch(Events::POST_CONSIGNMENT_CANCEL, $event);
    }

    /**
     * @param ConsignmentInterface $consignment
     * @return VendorAdapterInterface
     */
    private function getAdapter(ConsignmentInterface $consignment)
    {
        $vendor = $consignment->getVendor();
        $adapter = $this->adapterProvider->getVendorAdapter($vendor);
        if (! $adapter) {
            throw new VendorAdapterNotFoundException(
                sprintf('Vendor adapter for "%s" not found', $vendor->getCode())
            );
        }

        return $adapter;
    }
}
