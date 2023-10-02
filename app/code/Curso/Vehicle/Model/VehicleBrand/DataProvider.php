<?php
namespace Curso\Vehicle\Model\VehicleBrand;

use Curso\Vehicle\Model\ResourceModel\VehicleBrand\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Curso\Vehicle\Model\ResourceModel\VehicleBrand\Collection
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
     * @param CollectionFactory $vehicleBrandCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $vehicleBrandCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $vehicleBrandCollectionFactory->create();
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
        /** @var $vehicleBrand \Curso\Vehicle\Model\VehicleBrand */
        foreach ($items as $vehicleBrand) {
            $this->loadedData[$vehicleBrand->getId()] = $vehicleBrand->getData();
        }

        $data = $this->dataPersistor->get('vehicle_brand');
        if (!empty($data)) {
            $vehicleBrand = $this->collection->getNewEmptyItem();
            $vehicleBrand->setData($data);
            $this->loadedData[$vehicleBrand->getId()] = $vehicleBrand->getData();
            $this->dataPersistor->clear('vehicle_brand');
        }

        return $this->loadedData;
    }
}