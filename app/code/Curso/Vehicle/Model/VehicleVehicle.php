<?php
namespace Curso\Vehicle\Model;
use Curso\Vehicle\Api\Data\VehicleVehicleInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;

class VehicleVehicle extends AbstractModel implements IdentityInterface, VehicleVehicleInterface
{
    const CACHE_TAG = 'vehicle_vehicle';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct() {
        $this->_init('Curso\Vehicle\Model\ResourceModel\VehicleVehicle');
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
    public function getId(){
        return $this->getData(self::VEHICLE_VEHICLE_ID);
    }
    public function getPlate(){
        return $this->getData(self::PLATE);
    }
    public function getVehicleModelId(){
        return $this->getData(self::VEHICLE_MODEL_ID);
    }
    public function setId($id){
        return $this->setData(self::VEHICLE_VEHICLE_ID, $id);
    }
    public function setPlate($plate){
        return $this->setData(self::PLATE, $plate);
    }
    public function setVehicleModelId($vehicleModelId){
        return $this->setData(self::VEHICLE_MODEL_ID, $vehicleModelId);
    }

}
