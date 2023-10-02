<?php
namespace Curso\Vehicle\Model;
use Curso\Vehicle\Api\Data\VehicleModelInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;

class VehicleModel extends AbstractModel implements IdentityInterface, VehicleModelInterface
{
    const CACHE_TAG = 'vehicle_model';

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
        $this->_init('Curso\Vehicle\Model\ResourceModel\VehicleModel');
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
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
        return $this->getData(self::VEHICLE_MODEL_ID);
    }
    public function getModel(){
        return $this->getData(self::MODEL);
    }
    public function getBrandId(){
        return $this->getData(self::BRAND_ID);
    }
    public function setId($id){
        return $this->setData(self::VEHICLE_MODEL_ID, $id);
    }
    public function setModel($model){
        return $this->setData(self::MODEL, $model);
    }
    public function setBrandId($brandId){
        return $this->setData(self::BRAND_ID, $brandId);
    }
}
