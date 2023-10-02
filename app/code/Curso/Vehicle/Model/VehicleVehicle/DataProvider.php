<?php
namespace Curso\Vehicle\Model\VehicleVehicle;

use Curso\Vehicle\Model\ResourceModel\VehicleVehicle\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Curso\Vehicle\Model\ResourceModel\VehicleVehicle\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $VehicleVehicleCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $VehicleVehicleCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $VehicleVehicleCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var $VehicleVehicle \Curso\Vehicle\Model\VehicleVehicle */
        foreach ($items as $VehicleVehicle) {
            $this->loadedData[$VehicleVehicle->getId()] = $VehicleVehicle->getData();
        }

        $data = $this->dataPersistor->get('vehicle_vehicle');
        if (!empty($data)) {
            $VehicleVehicle = $this->collection->getNewEmptyItem();
            $VehicleVehicle->setData($data);
            $this->loadedData[$VehicleVehicle->getId()] = $VehicleVehicle->getData();
            $this->dataPersistor->clear('vehicle_vehicle');
        }

        return $this->loadedData;
    }
}