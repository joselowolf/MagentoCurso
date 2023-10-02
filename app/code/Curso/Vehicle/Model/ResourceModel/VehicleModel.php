<?php
namespace Curso\Vehicle\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;

class VehicleModel extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	protected $_date;
	
	public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
		\Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        parent::__construct($context);
		$this->_date = $date;
    }
	
	/**
     * Define main table
     */
	protected function _construct()
	{
		$this->_init('vehicle_model', 'vehicle_model_id');
	}
    /**
     * Set updated_at and created_at before save
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return object
     */
	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setUpdatedAt($this->_date->date());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->_date->date());
        }
        return parent::_beforeSave($object);
    }
}