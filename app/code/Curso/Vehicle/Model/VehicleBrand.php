<?php
namespace Curso\Vehicle\Model;
use Curso\Vehicle\Api\Data\VehicleBrandInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;

class VehicleBrand extends AbstractModel implements IdentityInterface, VehicleBrandInterface
{
    const CACHE_TAG = 'vehicle_brand';

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
        $this->_init('Curso\Vehicle\Model\ResourceModel\VehicleBrand');
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
        return $this->getData(self::VEHICLE_BRAND_ID);
    }
    public function getBrand(){
        return $this->getData(self::BRAND);
    }
    public function setId($id){
        return $this->setData(self::VEHICLE_BRAND_ID, $id);
    }
    public function setBrand($brand){
        return $this->setData(self::BRAND, $brand);
    }
}
