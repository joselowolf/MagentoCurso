<?php
namespace Curso\Vehicle\Model;
use Curso\Vehicle\Api\Data;
use Curso\Vehicle\Api\VehicleVehicleRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Curso\Vehicle\Model\ResourceModel\VehicleVehicle as ResourceVehicleVehicle;
use Curso\Vehicle\Model\ResourceModel\VehicleVehicle\CollectionFactory as VehicleVehicleCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class VehicleVehiclelRepository implements VehicleVehicleRepositoryInterface
{
    protected $resource;
    protected $vehicleVehicleFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $dataVehicleVehicleFactory;
    private $storeManager;

    public function __construct(
        ResourceVehicleVehicle $resource,
        VehicleVehicleFactory $vehicleVehicleFactory,
        Data\VehicleVehicleInterfaceFactory $dataVehicleVehicleFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->vehicleVehicleFactory = $vehicleVehicleFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataVehicleVehicleFactory = $dataVehicleVehicleFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }
    public function save(\Curso\Vehicle\Api\Data\VehicleVehicleInterface $vehicleVehicle)
    {
        if ($vehicleVehicle->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $vehicleVehicle->setStoreId($storeId);
        }
        try {
            $vehicleVehicle->getResource()->save($vehicleVehicle);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the vehicleVehicle: %1',
                $exception->getMessage()
            ));
        }
        return $vehicleVehicle;
    }
    public function getById($vehicleVehicleId)
    {
        $vehicleVehicle = $this->vehicleVehicleFactory->create();
        $vehicleVehicle->getResource()->load($vehicleVehicle, $vehicleVehicleId);
        if (!$vehicleVehicle->getId()) {
            throw new NoSuchEntityException(__('VehicleVehicle with id "%1" does not exist.', $vehicleVehicleId));
        }
        return $vehicleVehicle;
    }
    public function delete(\Curso\Vehicle\Api\Data\VehicleVehicleInterface $vehicleVehicle)
    {
        try {
            $vehicleVehicle->getResource()->delete($vehicleVehicle);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the VehicleVehicle: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
    public function deleteById($vehicleVehicleId)
    {
        return $this->delete($this->getById($vehicleVehicleId));
    }

}