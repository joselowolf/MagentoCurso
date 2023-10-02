<?php
namespace Curso\Vehicle\Model;
use Curso\Vehicle\Api\Data;
use Curso\Vehicle\Api\VehicleModelRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Curso\Vehicle\Model\ResourceModel\VehicleModel as ResourceVehicleModel;
use Curso\Vehicle\Model\ResourceModel\VehicleModel\CollectionFactory as VehicleModelCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class VehicleModellRepository implements VehicleModelRepositoryInterface
{
    protected $resource;
    protected $vehicleModelFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $dataVehicleModelFactory;
    private $storeManager;

    public function __construct(
        ResourceVehicleModel $resource,
        VehicleModelFactory $vehicleModeFactory,
        Data\VehicleModelInterfaceFactory $dataVehicleModelFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->vehicleModeFactory = $vehicleModeFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataVehicleModelFactory = $dataVehicleModelFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }
    public function save(\Curso\Vehicle\Api\Data\VehicleModelInterface $vehicleMode)
    {
        if ($vehicleMode->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $vehicleMode->setStoreId($storeId);
        }
        try {
            $vehicleMode->getResource()->save($vehicleMode);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the vehicleMode: %1',
                $exception->getMessage()
            ));
        }
        return $vehicleMode;
    }
    public function getById($vehicleModeId)
    {
        $vehicleMode = $this->vehicleModeFactory->create();
        $vehicleMode->getResource()->load($vehicleMode, $vehicleModeId);
        if (!$vehicleMode->getId()) {
            throw new NoSuchEntityException(__('VehicleModel with id "%1" does not exist.', $vehicleModeId));
        }
        return $vehicleMode;
    }
    public function delete(\Curso\Vehicle\Api\Data\VehicleModelInterface $vehicleMode)
    {
        try {
            $vehicleMode->getResource()->delete($vehicleMode);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the VehicleModel: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
    public function deleteById($vehicleModeId)
    {
        return $this->delete($this->getById($vehicleModeId));
    }
    
}