<?php
namespace Curso\Vehicle\Model\VehicleModel;

use Curso\Vehicle\Model\ResourceModel\VehicleModel\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Curso\Vehicle\Model\ResourceModel\VehicleModel\Collection
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
     * @param CollectionFactory $vehicleModelCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $vehicleModelCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $vehicleModelCollectionFactory->create();
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
        /** @var $vehicleModel \Curso\Vehicle\Model\VehicleModel */
        foreach ($items as $vehicleModel) {
            $this->loadedData[$vehicleModel->getId()] = $vehicleModel->getData();
        }

        $data = $this->dataPersistor->get('vehicle_model');
        if (!empty($data)) {
            $vehicleModel = $this->collection->getNewEmptyItem();
            $vehicleModel->setData($data);
            $this->loadedData[$vehicleModel->getId()] = $vehicleModel->getData();
            $this->dataPersistor->clear('vehicle_model');
        }

        return $this->loadedData;
    }
}