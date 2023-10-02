<?php
namespace Curso\Vehicle\Model;
use Curso\Vehicle\Api\Data;
use Curso\Vehicle\Api\VehicleBrandRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Curso\Vehicle\Model\ResourceModel\VehicleBrand as ResourceVehicleBrand;
use Curso\Vehicle\Model\ResourceModel\VehicleBrand\CollectionFactory as VehicleBrandCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class VehicleBrandRepository implements VehicleBrandRepositoryInterface
{
    protected $resource;
    protected $vehicleBrandFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $dataVehicleBrandFactory;
    private $storeManager;

    public function __construct(
        ResourceVehicleBrand $resource,
        VehicleBrandFactory $vehicleBrandFactory,
        Data\VehicleBrandInterfaceFactory $dataVehicleBrandFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->vehicleBrandFactory = $vehicleBrandFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataVehicleBrandFactory = $dataVehicleBrandFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }
    public function save(\Curso\Vehicle\Api\Data\VehicleBrandInterface $vehicleBrand)
    {
        if ($vehicleBrand->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $vehicleBrand->setStoreId($storeId);
        }
        try {
            $vehicleBrand->getResource()->save($vehicleBrand);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the vehicleBrand: %1',
                $exception->getMessage()
            ));
        }
        return $vehicleBrand;
    }
    public function getById($vehicleBrandId)
    {
        $vehicleBrand = $this->vehicleBrandFactory->create();
        $vehicleBrand->getResource()->load($vehicleBrand, $vehicleBrandId);
        if (!$vehicleBrand->getId()) {
            throw new NoSuchEntityException(__('VehicleBrand with id "%1" does not exist.', $vehicleBrandId));
        }
        return $vehicleBrand;
    }
    public function delete(\Curso\Vehicle\Api\Data\VehicleBrandInterface $vehicleBrand)
    {
        try {
            $vehicleBrand->getResource()->delete($vehicleBrand);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the VehicleBrand: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
    public function deleteById($vehicleBrandId)
    {
        return $this->delete($this->getById($vehicleBrandId));
    }

}
